/* Functions */

const deleteModal = (button) => {
    setToken(button, "delete");

    let contact = button.dataset;

    $(`#modalTitle`).textContent = "Suppression d'un contact";
    $(`#modalForm`).action = `/contacts/delete/${contact.id}`;

    $("#deleteName").textContent = contact.name;
};

const addModal = (button) => {
    setToken(button, "modal");

    $(`#modalTitle`).textContent = "Ajout d'un contact";
    $(`#modalForm`).action = "/contacts/new";
};

const editModal = (button) => {
    addModal(button);

    let contact = button.dataset;

    $(`#modalTitle`).textContent = "Edition d'un contact";
    $(`#modalForm`).action = `/contacts/edit/${contact.id}`;

    $("#name").value = contact.name;
    $("#address").value = contact.address;
    $("#phone").value = contact.phone;
    $("#email").value = contact.email;
    $("#website").value = contact.website;

    setOptions(button, "type");
    setOptions(button, "role");
};