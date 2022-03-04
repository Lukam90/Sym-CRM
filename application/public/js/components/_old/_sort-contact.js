class SortContactElement extends HTMLElement {
    connectedCallback() {
        const column = this.getAttribute("column");

        this.innerHTML = `
            <sort-content table="contacts" column="${column}"></sort-content>
        `;
    }
}

customElements.define("sort-contact", SortContactElement);