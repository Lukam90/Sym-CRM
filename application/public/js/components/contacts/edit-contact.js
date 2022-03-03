class EditContactElement extends HTMLElement {
    connectedCallback() {
        const contact = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            <button
                class="button is-success"
                id="${contact.id}"
                name="${contact.fullName}"
                type="${contact.type}"
                role="${contact.role}"
                address="${contact.address}"
                phone="${contact.phone}"
                email="${contact.email}"
                website="${contact.website}"
                token="${token}"
                onclick="editModal(this)">
                <i class="fa fa-pencil"></i>
            </button>
        `;
    }
}

customElements.define("edit-contact", EditContactElement);