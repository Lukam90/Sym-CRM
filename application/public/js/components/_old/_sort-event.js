class SortEventElement extends HTMLElement {
    connectedCallback() {
        const column = this.getAttribute("column");

        this.innerHTML = `
            <sort-content table="events" column="${column}"></sort-content>
        `;
    }
}

customElements.define("sort-event", SortEventElement);