class EditTeamElement extends HTMLElement {
    connectedCallback() {
        const team = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            
        `;
    }
}

customElements.define("edit-team", EditTeamElement);