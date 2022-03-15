/**
 * Opens the modal window to delete a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _delete = (button) => {
    openModal(button, "delete");

    let team = getData(button);

    $("#delete-form").action = `/teams/delete/${team.id}`;
    $("#delete-name").textContent = team.name;
}

/**
 * Opens the modal window to add a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _add = (button) => {
    openModal(button, "modal");

    $("#modal-title").textContent = "Ajout d'une équipe";
    $("#modal-form").action = "/teams/new";
}

/**
 * Opens the modal window to edit a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _edit = (button) => {
    openModal(button, "modal");

    let team = getData(button);

    $("#modal-title").textContent = "Edition d'une équipe";
    $("#modal-form").action = `/teams/edit/${team.id}`;

    setValue("name", team.name);
}