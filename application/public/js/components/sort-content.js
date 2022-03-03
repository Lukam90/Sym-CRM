class SortContentElement extends HTMLElement {
    connectedCallback() {
        const table = this.getAttribute("table");
        const column = this.getAttribute("column");

        this.innerHTML = `
            <a href="/${table}/sort/${column}/asc">
                <i class="fa fa-arrow-up" aria-hidden="true"></i>
            </a>

            &nbsp;

            <a href="/${table}/sort/${column}/desc">
                <i class="fa fa-arrow-down" aria-hidden="true"></i>
            </a>
        `;
    }
}

customElements.define("sort-content", SortContentElement);