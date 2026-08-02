import { Controller } from '@hotwired/stimulus';

export default class extends Controller {
    static targets = ['category', 'retention', 'retentionLabel', 'stats'];

    connect() {
        this.element.addEventListener('page:init', () => this.render());
        document.addEventListener('dbready', () => this.render());
        if (window.db) {
            this.render();
        }
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

    async render() {
        if (!window.db) {
            return;
        }
        const [jokes, stats] = await Promise.all([window.db.jokes.toArray(), this.getStats()]);
        const categories = ['all', ...new Set(jokes.map((j) => j.category))];
        const selected = stats.selectedCategory || 'all';

        this.categoryTarget.innerHTML = categories
            .map((c) => `<option value="${c}"${c === selected ? ' selected' : ''}>${c}</option>`)
            .join('');

        this.retentionTarget.value = stats.desiredRetention ?? 0.9;
        this.retentionLabelTarget.textContent = `${Math.round((stats.desiredRetention ?? 0.9) * 100)}%`;

        this.statsTarget.innerHTML = `
            <span>🔥 ${stats.currentStreak} day streak</span>
            <span>${stats.totalReviews} reviews total</span>
        `;
    }

    async setCategory() {
        const stats = await this.getStats();
        stats.selectedCategory = this.categoryTarget.value;
        await window.db.stats.put(stats);
    }

    async setRetention() {
        const stats = await this.getStats();
        stats.desiredRetention = Number(this.retentionTarget.value);
        await window.db.stats.put(stats);
        this.retentionLabelTarget.textContent = `${Math.round(stats.desiredRetention * 100)}%`;
    }

    async resetProgress() {
        if (!window.confirm('Reset all review progress? This cannot be undone.')) {
            return;
        }
        await window.db.progress.clear();
        await this.render();
    }
}
