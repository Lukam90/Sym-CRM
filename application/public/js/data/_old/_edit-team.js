class EditTeamElement extends HTMLElement {
    connectedCallback() {
        const team = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            <button
                class="button is-success"
                id="{{ team.id }}"
                name="{{ team.name }}"
                token="{{ token }}"
                onclick="editTeam(this)">
                <i class="fa fa-pencil"></i>
            </button>
        `;
    }
}

customElements.define("edit-team", EditTeamElement);