class SearchUserElement extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <search-form table="users" placeholder="Jean Dupont"></search-form>
        `;
    }
}

customElements.define("search-user", SearchUserElement);