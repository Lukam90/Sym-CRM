function _delete(button) {
    setToken(button, "delete");

    let event = getData(button);

    $("#delete-title").textContent = "Suppression d'un événement";
    $("#delete-form").action = `/events/delete/${event.id}`;
    $("#deleteName").textContent = event.name;
}

function _add(button) {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'un événement";
    $("#modal-form").action = "/events/new";
}

function _edit(button) {
    setToken(button, "modal");

    let event = getData(button);

    $("#modal-title").textContent = "Edition d'un événement";
    $("#modal-form").action = `/events/edit/${event.id}`;

    setValue("name", event.name);
    setValue("address", event.address);
    setValue("phone", event.phone);
    setValue("email", event.email);
    setValue("website", event.website);

    setOptions("type", event.type);
    setOptions("role", event.role);
}