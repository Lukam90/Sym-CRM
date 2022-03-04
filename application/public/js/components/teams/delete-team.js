class DeleteTeamElement extends HTMLElement {
    connectedCallback() {
        const team = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            <button
                class="button is-danger"
                id="${team.id}"
                name="${team.name}"
                token="${token}"
                onclick="deleteTeam(this)">
                <i class="fa fa-times"></i>
            </button>
        `;
    }
}

customElements.define("delete-team", DeleteTeamElement);