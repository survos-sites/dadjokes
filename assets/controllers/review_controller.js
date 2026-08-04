import { Controller } from '@hotwired/stimulus';
import { emptyCard, grade, Rating } from '../lib/fsrs.js';

/** Mirrors the API's order: little_kids first (safe/universal), then by rating desc, then manual sortOrder. */
function byBrowseOrder(a, b) {
    if (a.ageGroup !== b.ageGroup) {
        return a.ageGroup === 'little_kids' ? -1 : 1;
    }
    return b.rating - a.rating || a.sortOrder - b.sortOrder;
}

/*
* Fully offline: jokes + progress both live in IndexedDB (seeded once from
* /api/jokes by mobile-bundle's app controller via DbUtilities). Grading
* never touches the server — see docs/events.md in fw-bundle for why we
* listen on the real F7 v9 DOM event names below.
*
* Keyboard: Up = Good, Down = Again, Left/Right = browse all cards in order
* (ignores the FSRS due-queue and category filter — just skimming), no
* grading side effect. Grading always resumes from wherever the FSRS queue
* actually is on the next card, regardless of where browsing left off.
*/
export default class extends Controller {
    static targets = ['card', 'front', 'back', 'due', 'remaining', 'learnToggle', 'playToggle'];

    connect() {
        this.autoPlaying = false;
        this.renderToken = 0;
        this.onKeydown = this.onKeydown.bind(this);
        window.addEventListener('keydown', this.onKeydown);
        this.element.addEventListener('page:init', () => this.loadNext());
        document.addEventListener('dbready', () => this.loadNext());
        if (window.db) {
            this.loadNext();
        }
    }

    disconnect() {
        this.autoPlaying = false;
        window.removeEventListener('keydown', this.onKeydown);
        window.speechSynthesis?.cancel();
    }

    onKeydown(e) {
        if (['INPUT', 'TEXTAREA', 'SELECT'].includes(e.target.tagName)) {
            return;
        }
        switch (e.key) {
            case 'ArrowUp':
                e.preventDefault();
                this.gradeCurrent(Rating.Good);
                break;
            case 'ArrowDown':
                e.preventDefault();
                this.gradeCurrent(Rating.Again);
                break;
            case 'ArrowRight':
                e.preventDefault();
                this.navigateManual(1);
                break;
            case 'ArrowLeft':
                e.preventDefault();
                this.navigateManual(-1);
                break;
            default:
                break;
        }
    }

    flip() {
        this.cardTarget.classList.toggle('flipped');
    }

    async grade(e) {
        await this.gradeCurrent(Number(e.params.rating));
    }

    async gradeCurrent(rating) {
        if (!this.currentProgress) {
            return;
        }
        const stats = await this.getStats();
        const updated = grade(this.currentProgress, rating, stats.desiredRetention);
        await window.db.progress.put({ id: this.currentProgress.id, ...updated });
        await this.recordReview(stats);
        this.loadNext();
    }

    async getStats() {
        return (await window.db.stats.get('local')) ?? {
            id: 'local',
            currentStreak: 0,
            longestStreak: 0,
            lastReviewedOn: null,
            totalReviews: 0,
            desiredRetention: 0.9,
            selectedCategory: 'all',
            learnMode: false,
        };
    }

    async recordReview(stats) {
        const today = new Date().toISOString().slice(0, 10);
        if (stats.lastReviewedOn !== today) {
            const yesterday = new Date(Date.now() - 86400000).toISOString().slice(0, 10);
            stats.currentStreak = stats.lastReviewedOn === yesterday ? stats.currentStreak + 1 : 1;
            stats.longestStreak = Math.max(stats.longestStreak, stats.currentStreak);
            stats.lastReviewedOn = today;
        }
        stats.totalReviews += 1;
        await window.db.stats.put(stats);
        if (this.hasDueTarget) {
            this.dueTarget.textContent = `🔥 ${stats.currentStreak}`;
        }
    }

    // --- Learn mode: show both sides at once, no flip needed ---

    async toggleLearnMode() {
        const stats = await this.getStats();
        stats.learnMode = !stats.learnMode;
        await window.db.stats.put(stats);
        this.applyLearnMode(stats.learnMode);
    }

    applyLearnMode(on) {
        this.cardTarget.classList.toggle('learn-mode', on);
        if (this.hasLearnToggleTarget) {
            this.learnToggleTarget.textContent = on ? 'Learn: On' : 'Learn: Off';
            this.learnToggleTarget.classList.toggle('button-fill', on);
        }
    }

    // --- Voice: Web Speech API, no server/dependency needed ---

    speak(text) {
        return new Promise((resolve) => {
            if (!window.speechSynthesis) {
                resolve();
                return;
            }
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.onend = resolve;
            utterance.onerror = resolve;
            window.speechSynthesis.speak(utterance);
        });
    }

    wait(ms) {
        return new Promise((resolve) => setTimeout(resolve, ms));
    }

    async speakCurrent() {
        if (!this.currentCard) {
            return;
        }
        await this.speak(this.currentCard.keyword);
        await this.wait(400);
        await this.speak(this.currentCard.joke);
    }

    /** Hands-free listen-through: speaks front, back, then advances. Stoppable. */
    async toggleAutoPlay() {
        if (this.autoPlaying) {
            this.autoPlaying = false;
            window.speechSynthesis?.cancel();
            this.updatePlayToggle();
            return;
        }
        this.autoPlaying = true;
        this.updatePlayToggle();
        while (this.autoPlaying) {
            if (!this.currentCard) {
                break;
            }
            await this.speak(this.currentCard.keyword);
            if (!this.autoPlaying) break;
            await this.wait(1200);
            if (!this.autoPlaying) break;
            await this.speak(this.currentCard.joke);
            if (!this.autoPlaying) break;
            await this.wait(1800);
            if (!this.autoPlaying) break;
            this.navigateManual(1);
        }
        this.updatePlayToggle();
    }

    updatePlayToggle() {
        if (this.hasPlayToggleTarget) {
            this.playToggleTarget.textContent = this.autoPlaying ? '⏹ Stop' : '▶ Play all';
            this.playToggleTarget.classList.toggle('button-fill', this.autoPlaying);
        }
    }

    // --- Manual browse (arrow left/right): all cards, in order, no grading ---

    async navigateManual(direction) {
        const token = ++this.renderToken;
        if (!this.allJokes || !this.allJokes.length) {
            this.allJokes = (await window.db.jokes.toArray()).sort(byBrowseOrder);
        }
        if (!this.allJokes.length) {
            return;
        }
        const currentIndex = this.currentCard
            ? this.allJokes.findIndex((j) => j.id === this.currentCard.id)
            : 0;
        const nextIndex = (currentIndex + direction + this.allJokes.length) % this.allJokes.length;
        const card = this.allJokes[nextIndex];
        const progress = (await window.db.progress.get(card.id)) ?? { id: card.id, ...emptyCard() };
        if (token !== this.renderToken) {
            return;
        }
        this.currentProgress = progress;
        await this.renderCard(card, token);
    }

    // --- Rendering ---

    /**
     * Every navigation (grade/browse) stamps a fresh renderToken; if a newer
     * navigation started while this one was awaiting IndexedDB, bail instead
     * of clobbering it — fixes arrow-key browsing losing to an in-flight
     * loadNext() from a just-tapped grade button.
     */
    async renderCard(card, token = ++this.renderToken) {
        const stats = await this.getStats();
        if (token !== this.renderToken) {
            return;
        }
        this.currentCard = card;
        this.cardTarget.classList.remove('flipped');
        this.applyLearnMode(!!stats.learnMode);
        this.frontTarget.textContent = card.keyword;
        this.backTarget.textContent = card.joke;
    }

    async loadNext() {
        if (!window.db) {
            return;
        }
        const token = ++this.renderToken;

        const jokes = await window.db.jokes.toArray();
        if (!jokes.length) {
            return;
        }
        this.allJokes = jokes.slice().sort(byBrowseOrder);

        let progress = await window.db.progress.toArray();
        if (progress.length < jokes.length) {
            const known = new Set(progress.map((p) => p.id));
            const seed = jokes
                .filter((j) => !known.has(j.id))
                .map((j) => ({ id: j.id, ...emptyCard() }));
            await window.db.progress.bulkPut(seed);
            progress = await window.db.progress.toArray();
        }

        const stats = await this.getStats();
        const category = stats.selectedCategory || 'all';
        const jokesById = new Map(jokes.map((j) => [j.id, j]));
        const scoped = category === 'all'
            ? progress
            : progress.filter((p) => jokesById.get(p.id)?.category === category);

        if (token !== this.renderToken) {
            return;
        }
        if (!scoped.length) {
            this.frontTarget.textContent = 'No cards in this set';
            this.backTarget.textContent = 'Pick a different set in Settings.';
            if (this.hasRemainingTarget) {
                this.remainingTarget.textContent = '';
            }
            return;
        }

        scoped.sort((a, b) => new Date(a.due).getTime() - new Date(b.due).getTime());
        const next = scoped[0];
        const card = jokesById.get(next.id);
        if (!card) {
            return;
        }

        this.currentProgress = next;
        await this.renderCard(card, token);
        if (token !== this.renderToken) {
            return;
        }
        if (this.hasRemainingTarget) {
            const dueCount = scoped.filter((p) => new Date(p.due).getTime() <= Date.now()).length;
            this.remainingTarget.textContent = `${dueCount} due · ${scoped.length} total`;
        }
        if (this.hasDueTarget) {
            this.dueTarget.textContent = `🔥 ${stats.currentStreak}`;
        }
    }
}
