class SortUserElement extends HTMLElement {
    connectedCallback() {
        const column = this.getAttribute("column");

        this.innerHTML = `
            <sort-content table="users" column="${column}"></sort-content>
        `;
    }
}

customElements.define("sort-user", SortUserElement);