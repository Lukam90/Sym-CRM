class DeleteEventElement extends HTMLElement {
    connectedCallback() {
        const event = JSON.parse(this.getAttribute("data"));
        const token = this.getAttribute("token");

        this.innerHTML = `
            <button
                class="button is-danger"
                data-modal-title="Suppression d'un événement"
                data-form-action="/events/delete/{{ event.id }}"
                data-title="{{ event.title }}"
                data-token="{{ csrf_token('delete') }}"
                onclick="deleteModal(this)">
                <i class="fa fa-times"></i>
            </button>
        `;
    }
}

customElements.define("delete-event", DeleteEventElement);