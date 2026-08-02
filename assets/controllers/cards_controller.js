import { Controller } from '@hotwired/stimulus';

/** Browse-all-cards page — read-only list, tap a row to reveal its answer. */
export default class extends Controller {
    static targets = ['list', 'filter'];

    connect() {
        this.element.addEventListener('page:init', () => this.render());
        document.addEventListener('dbready', () => this.render());
        if (window.db) {
            this.render();
        }
    }

    async render() {
        if (!window.db) {
            return;
        }
        const jokes = await window.db.jokes.toArray();
        jokes.sort((a, b) => a.category.localeCompare(b.category) || a.keyword.localeCompare(b.keyword));

        const categories = ['all', ...new Set(jokes.map((j) => j.category))];
        this.filterTarget.innerHTML = categories
            .map((c) => `<button type="button" class="button button-small${c === this.activeCategory() ? ' button-fill' : ''}" data-action="cards#filterBy" data-category="${c}">${c}</button>`)
            .join(' ');

        const active = this.activeCategory();
        const visible = active === 'all' ? jokes : jokes.filter((j) => j.category === active);

        this.listTarget.innerHTML = visible.map((j) => `
            <div class="card-row" data-action="click->cards#toggle">
                <div class="card-row-front">
                    <span class="card-row-keyword">${this.escape(j.keyword)}</span>
                    <span class="card-row-category">${this.escape(j.category)}</span>
                </div>
                <div class="card-row-back">${this.escape(j.joke)}</div>
            </div>
        `).join('');
    }

    activeCategory() {
        return this._activeCategory || 'all';
    }

    filterBy(e) {
        this._activeCategory = e.currentTarget.dataset.category;
        this.render();
    }

    toggle(e) {
        e.currentTarget.classList.toggle('open');
    }

    escape(value) {
        const div = document.createElement('div');
        div.textContent = value;
        return div.innerHTML;
    }
}
