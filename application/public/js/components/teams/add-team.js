class AddTeamElement extends HTMLElement {
    connectedCallback() {
        const token = this.getAttribute("token");

        this.innerHTML = `
            <add-button type="Team" label="Nouvelle équipe" token="${token}"></add-button>
        `;
    }
}

customElements.define("add-team", AddTeamElement);