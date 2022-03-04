class AddUserElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");

        this.innerHTML = `
            <add-button type="User" label="Nouvel utilisateur" token="${token}"></add-button>
        `;
    }
}

customElements.define("add-user", AddUserElement);