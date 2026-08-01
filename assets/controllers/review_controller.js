import { Controller } from '@hotwired/stimulus';
import { grade } from '../lib/leitner.js';

/*
* Fully offline: jokes + progress both live in IndexedDB (seeded once from
* /api/jokes by mobile-bundle's app controller via DbUtilities). Grading
* never touches the server — see docs/events.md in fw-bundle for why we
* listen on the real F7 v9 DOM event names below.
*/
export default class extends Controller {
    static targets = ['card', 'front', 'back'];

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
        const correct = e.params.correct;
        await window.db.progress.put(grade(this.currentProgress, correct));
        this.loadNext();
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
            const now = new Date().toISOString();
            const seed = jokes
                .filter((j) => !known.has(j.id))
                .map((j) => ({ id: j.id, box: 1, dueAt: now }));
            await window.db.progress.bulkPut(seed);
            progress = await window.db.progress.toArray();
        }

        progress.sort((a, b) => a.dueAt.localeCompare(b.dueAt));
        const next = progress[0];
        const card = jokes.find((j) => j.id === next.id);
        if (!card) {
            return;
        }

        this.currentProgress = next;
        this.cardTarget.classList.remove('flipped');
        this.frontTarget.textContent = card.keyword;
        this.backTarget.textContent = card.joke;
    }
}
