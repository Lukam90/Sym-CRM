class SortTeamElement extends HTMLElement {
    connectedCallback() {
        const column = this.getAttribute("column");

        this.innerHTML = `
            <sort-content table="teams" column="${column}"></sort-content>
        `;
    }
}

customElements.define("sort-team", SortTeamElement);