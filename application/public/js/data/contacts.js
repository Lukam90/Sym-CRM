/**
 * Opens the modal window to delete a contact
 * 
 * @param {HTMLButtonElement} button 
 */
const _delete = (button) => {
    setToken(button, "delete");

    let contact = getData(button);

    $("#delete-title").textContent = "Suppression d'un contact";
    $("#delete-form").action = `/contacts/delete/${contact.id}`;
    $("#delete-name").textContent = contact.fullName;
}

/**
 * Opens the modal window to add a contact
 * 
 * @param {HTMLButtonElement} button 
 */
const _add = (button) => {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'un contact";
    $("#modal-form").action = "/contacts/new";
}

/**
 * Opens the modal window to edit a user's role
 * 
 * @param {HTMLButtonElement} button 
 */
const _edit = (button) => {
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