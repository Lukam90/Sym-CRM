class EditUserElement extends HTMLElement {
    connectedCallback() {
        const user = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            
        `;
    }
}

customElements.define("edit-user", EditUserElement);