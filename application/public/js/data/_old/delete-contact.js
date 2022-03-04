class DeleteContactElement extends HTMLElement {
    connectedCallback() {
        const contact = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            <button
                class="button is-danger"
                id="{{ contact.id }}"
                name="{{ contact.fullName }}"
                token="{{ token }}"
                onclick="deleteContact(this)">
                <i class="fa fa-times"></i>
            </button>
        `;
    }
}

customElements.define("delete-contact", DeleteContactElement);