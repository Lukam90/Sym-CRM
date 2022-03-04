function _delete(button) {
    setToken(button, "delete");

    let contact = getData(button);

    $("#delete-title").textContent = "Suppression d'un contact";
    $("#delete-form").action = `/contacts/delete/${contact.id}`;
    $("#deleteName").textContent = contact.fullName;
}

function _add(button) {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'un contact";
    $("#modal-form").action = "/contacts/new";
}

function _edit(button) {
    setToken(button, "modal");

    let contact = getData(button);

    $("#modal-title").textContent = "Edition d'un contact";
    $("#modal-form").action = `/contacts/edit/${contact.id}`;

    setValue("name", contact.fullName);
    setValue("address", contact.address);
    setValue("phone", contact.phone);
    setValue("email", contact.email);
    setValue("website", contact.website);

    setOptions("type", contact.type);
    setOptions("role", contact.role);
}