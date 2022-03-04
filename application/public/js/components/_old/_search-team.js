class SearchTeamElement extends HTMLElement {
    connectedCallback() {
        this.innerHTML = `
            <search-form table="teams" placeholder="Equipe de Jean Dupont"></search-form>
        `;
    }
}

customElements.define("search-team", SearchTeamElement);