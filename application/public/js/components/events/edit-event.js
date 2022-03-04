class EditEventElement extends HTMLElement {
    connectedCallback() {
        const event = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            
        `;
    }
}

customElements.define("edit-event", EditEventElement);