function _delete(button) {
    setToken(button, "delete");

    let event = getData(button);

    $("#delete-title").textContent = "Suppression d'un événement";
    $("#delete-form").action = `/events/delete/${event.id}`;
    $("#delete-name").textContent = event.title;
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

    setValue("title", event.title);
    setValue("date", formatDate(new Date(event.date)));
    setValue("description", event.description);

    setOptions("type", event.type);
}