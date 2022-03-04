class SearchEventElement extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <search-form table="events" placeholder="RDV avec Jean Dupont"></search-form>
        `;
    }
}

customElements.define("search-event", SearchEventElement);