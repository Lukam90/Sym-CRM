function _delete(button) {
    setToken(button, "delete");

    let id = button.getAttribute("id");
    let name = button.getAttribute("name");

    $("#deleteTitle").textContent = "Suppression d'un contact";
    $("#deleteForm").action = `/contacts/delete/${id}`;
    $("#deleteName").textContent = name;
}

function _add(button) {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un contact";
    $("#modalForm").action = "/contacts/new";
}

function _edit(button) {
    setToken(button, "modal");

    let id = button.getAttribute("id");

    $("#modalTitle").textContent = "Edition d'un contact";
    $("#modalForm").action = `/contacts/edit/${id}`;

    setValue(button, "name");
    setValue(button, "address");
    setValue(button, "phone");
    setValue(button, "email");
    setValue(button, "website");

    setOptions(button, "type");
    setOptions(button, "role");
}