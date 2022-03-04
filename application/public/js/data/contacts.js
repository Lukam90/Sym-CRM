function _delete(button) {
    setToken(button, "delete");

    let contact = getData(button);

    $("#deleteTitle").textContent = "Suppression d'un contact";
    $("#deleteForm").action = `/contacts/delete/${contact.id}`;
    $("#deleteName").textContent = contact.fullName;
}

function _add(button) {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un contact";
    $("#modalForm").action = "/contacts/new";
}

function _edit(button) {
    setToken(button, "modal");

    let contact = getData(button);

    $("#modalTitle").textContent = "Edition d'un contact";
    $("#modalForm").action = `/contacts/edit/${contact.id}`;

    setValue("name", contact.fullName);
    setValue("address", contact.address);
    setValue("phone", contact.phone);
    setValue("email", contact.email);
    setValue("website", contact.website);

    setOptions("type", contact.type);
    setOptions("role", contact.role);
}