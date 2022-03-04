class AddButtonElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");
        const label = this.getAttribute("label");
        const type = this.getAttribute("type");

        this.innerHTML = `
            <div class="block">
                <button
                    class="button is-link"
                    token="${token}"
                    onclick="add${type}(this);">
                    <i class="fa fa-plus"></i> &nbsp; ${label}
                </button>
            </div>
        `;
    }
}

customElements.define("add-button", AddButtonElement);