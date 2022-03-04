class SearchContactElement extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <search-form table="contacts" placeholder="Jean Dupont"></search-form>
        `;
    }
}

customElements.define("search-contact", SearchContactElement);