class DetailsContactElement extends HTMLElement {
    connectedCallback() {
        const contact = JSON.parse(this.getAttribute("data"));

        this.innerHTML = `
            <i class="fa fa-map-marker"></i> &nbsp; {{ contact.address}<br />
            <i class="fa fa-at"></i> &nbsp; {{ contact.email}<br />
            <i class="fa fa-phone"></i> &nbsp; {{ contact.phone}<br />

            {{ contact.website ? `<i class="fa fa-globe"></i> &nbsp; {{ contact.website}` : ""}
        `;
    }
}

customElements.define("details-contact", DetailsContactElement);