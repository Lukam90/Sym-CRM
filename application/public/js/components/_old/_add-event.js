class AddEventElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");

        this.innerHTML = `
            <add-button type="Event" label="Nouvel événement" token="${token}"></add-button>
        `;
    }
}

customElements.define("add-event", AddEventElement);