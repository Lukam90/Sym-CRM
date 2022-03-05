/**
 * Opens the modal window to delete a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _delete = (button) => {
    setToken(button, "delete");

    let team = getData(button);

    $("#delete-title").textContent = "Suppression d'une équipe";
    $("#delete-form").action = `/teams/delete/${team.id}`;
    $("#delete-name").textContent = team.name;
}

/**
 * Opens the modal window to add a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _add = (button) => {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'une équipe";
    $("#modal-form").action = "/teams/new";
}

/**
 * Opens the modal window to edit a team
 * 
 * @param {HTMLButtonElement} button 
 */
const _edit = (button) => {
    setToken(button, "modal");

    let team = getData(button);

    $("#modal-title").textContent = "Edition d'une équipe";
    $("#modal-form").action = `/teams/edit/${team.id}`;

    setValue("name", team.name);
}