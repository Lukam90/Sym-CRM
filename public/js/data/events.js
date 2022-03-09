/**
 * Opens the modal window to delete an event
 * 
 * @param {HTMLButtonElement} button 
 */
const _delete = (button) => {
    setToken(button, "delete");

    let event = getData(button);

    $("#delete-title").textContent = "Suppression d'un événement";
    $("#delete-form").action = `/events/delete/${event.id}`;
    $("#delete-name").textContent = event.title;
}

/**
 * Opens the modal window to add an event
 * 
 * @param {HTMLButtonElement} button 
 */
const _add = (button) => {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'un événement";
    $("#modal-form").action = "/events/new";
}

/**
 * Opens the modal window to edit an event
 * 
 * @param {HTMLButtonElement} button 
 */
const _edit = (button) => {
    setToken(button, "modal");

    let event = getData(button);

    $("#modal-title").textContent = "Edition d'un événement";
    $("#modal-form").action = `/events/edit/${event.id}`;

    setValue("title", event.title);
    setValue("date", formatDate(event.date));
    setValue("description", event.description);

    setOptions("type", event.type);
}