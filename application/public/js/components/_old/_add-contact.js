class AddContactElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");

        this.innerHTML = `
            <add-button type="Contact" label="Nouveau contact" token="${token}"></add-button>
        `;
    }
}

customElements.define("add-contact", AddContactElement);