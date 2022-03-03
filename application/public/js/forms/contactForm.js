const deleteModal = (button) => {
    setToken(button, "delete");

    let contact = JSON.parse(button.dataset.contact);

    $("#deleteTitle").textContent = "Suppression d'un contact";
    $("#deleteForm").action = `/contacts/delete/${contact.id}`;

    $("#deleteName").textContent = contact.fullName;
};

const addModal = (button) => {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un contact";
    $("#modalForm").action = "/contacts/new";
};

const editModal = (button) => {
    setToken(button, "modal");

    let contact = JSON.parse(button.dataset.contact);

    $("#modalTitle").textContent = "Edition d'un contact";
    $("#modalForm").action = `/contacts/edit/${contact.id}`;

    $("#name").value = contact.fullName;
    $("#address").value = contact.address;
    $("#phone").value = contact.phone;
    $("#email").value = contact.email;
    $("#website").value = contact.website;

    setOptions(contact, "type");
    setOptions(contact, "role");
};