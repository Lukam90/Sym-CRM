function _delete(button) {
    setToken(button, "delete");

    let event = getData(button);

    $("#deleteTitle").textContent = "Suppression d'un événement";
    $("#deleteForm").action = `/events/delete/${event.id}`;
    $("#deleteName").textContent = event.name;
}

function _add(button) {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un événement";
    $("#modalForm").action = "/events/new";
}

function _edit(button) {
    setToken(button, "modal");

    let event = getData(button);

    $("#modalTitle").textContent = "Edition d'un événement";
    $("#modalForm").action = `/events/edit/${event.id}`;

    setValue("name", event.name);
    setValue("address", event.address);
    setValue("phone", event.phone);
    setValue("email", event.email);
    setValue("website", event.website);

    setOptions("type", event.type);
    setOptions("role", event.role);
}