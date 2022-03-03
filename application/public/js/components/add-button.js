class AddButtonElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");
        const label = this.getAttribute("label");

        this.innerHTML = `
            <div class="block">
                <button
                    class="button is-link"
                    data-token="${token}"
                    onclick="addModal(this);">
                    <i class="fa fa-plus"></i> &nbsp; ${label}
                </button>
            </div>
        `;
    }
}

customElements.define("add-button", AddButtonElement);