/* Data */



/* Functions */

const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.name;
};

const editModal = (button) => {
    addModal(button);

    let dataset = button.dataset;

    $("#name").value = dataset.name;
    $("#address").value = dataset.address;
    $("#phone").value = dataset.phone;
    $("#email").value = dataset.email;
    $("#website").value = dataset.website;

    setOptions(button, "type");
    setOptions(button, "role");
};

const buildTable = (column = 'id', order = 'asc') => {
    const table = $("#table");

    let contacts = [];

    table.innerHTML = "";

    axios.post(`/contacts/sort/${column}/${order}`)
    .then(response => {
        contacts = response.data;

        //console.log(contacts);

        for (let contact in contacts) {
            let websiteLine = `<i class="fa fa-globe"></i> &nbsp; ${contact.website}`;
    
            let details = `
                <i class="fa fa-map-marker"></i> &nbsp; ${contact.address}<br />
                <i class="fa fa-at"></i> &nbsp; ${contact.email}<br />
                <i class="fa fa-phone"></i> &nbsp; ${contact.phone}<br />
                ${contact.website ? websiteLine : ""}
            `;
    
            let editButton = `
                <button
                    class="button is-success"
                    data-modal-title="Edition d'un contact"
                    data-form-action="/contacts/edit/${contact.id}"
                    data-name="${contact.fullName}"
                    data-type="${contact.type}"
                    data-role="${contact.role}"
                    data-address="${contact.address}"
                    data-phone="${contact.phone}"
                    data-email="${contact.email}"
                    data-website="${contact.website}"
                    data-token="{{ csrf_token('edit') }}"
                    onclick="editModal(this)">
                    <i class="fa fa-pencil"></i>
                </button>
            `;
    
            let deleteButton = `
                <button
                    class="button is-danger"
                    data-modal-title="Suppression d'un contact"
                    data-form-action="/contacts/delete/${contact.id}"
                    data-name="${contact.fullName}"
                    onclick="deleteModal(this)">
                    <i class="fa fa-times"></i>
                </button>
            `;
    
            let line = `
                <tr>
                    <td>${contact.id}</td>
                    <td>${contact.fullName}</td>
                    <td>${contact.type}</td>
                    <td>${contact.role}</td>
                    <td>${details}</td>
                    
                    <td>${editButton}</td>
                    <td>${deleteButton}</td>
                </tr>
            `;
    
            table.innerHTML += line;
        }
    })
    .catch(error => console.log(error));

    if (contacts.length == 0) {
        table.innerHTML = `
            <tr>
                <td colspan="7">Aucun contact n'a été ajouté.</td>
            </tr>
        `;
    }
};