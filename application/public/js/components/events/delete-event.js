class DeleteEventElement extends HTMLElement {
    connectedCallback() {
        const event = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            
        `;
    }
}

customElements.define("delete-event", DeleteEventElement);