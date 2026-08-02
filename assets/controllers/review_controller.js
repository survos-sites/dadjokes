import { Controller } from '@hotwired/stimulus';
import { emptyCard, grade } from '../lib/fsrs.js';

/*
* Fully offline: jokes + progress both live in IndexedDB (seeded once from
* /api/jokes by mobile-bundle's app controller via DbUtilities). Grading
* never touches the server — see docs/events.md in fw-bundle for why we
* listen on the real F7 v9 DOM event names below.
*/
export default class extends Controller {
    static targets = ['card', 'front', 'back', 'due', 'remaining'];

    connect() {
        this.element.addEventListener('page:init', () => this.loadNext());
        document.addEventListener('dbready', () => this.loadNext());
        if (window.db) {
            this.loadNext();
        }
    }

    flip() {
        this.cardTarget.classList.toggle('flipped');
    }

    async grade(e) {
        if (!this.currentProgress) {
            return;
        }
        const rating = Number(e.params.rating);
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

    async loadNext() {
        if (!window.db) {
            return;
        }

        const jokes = await window.db.jokes.toArray();
        if (!jokes.length) {
            return;
        }

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
        this.cardTarget.classList.remove('flipped');
        this.frontTarget.textContent = card.keyword;
        this.backTarget.textContent = card.joke;
        if (this.hasRemainingTarget) {
            const dueCount = scoped.filter((p) => new Date(p.due).getTime() <= Date.now()).length;
            this.remainingTarget.textContent = `${dueCount} due · ${scoped.length} total`;
        }
        if (this.hasDueTarget) {
            this.dueTarget.textContent = `🔥 ${stats.currentStreak}`;
        }
    }
}
