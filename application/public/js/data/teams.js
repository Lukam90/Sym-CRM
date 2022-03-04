function _delete(button) {
    setToken(button, "delete");

    let team = getData(button);

    $("#delete-title").textContent = "Suppression d'une équipe";
    $("#delete-form").action = `/teams/delete/${team.id}`;
    $("#deleteName").textContent = team.name;
}

function _add(button) {
    setToken(button, "modal");

    $("#modal-title").textContent = "Ajout d'une équipe";
    $("#modal-form").action = "/teams/new";
}

function _edit(button) {
    setToken(button, "modal");

    let team = getData(button);

    $("#modal-title").textContent = "Edition d'une équipe";
    $("#modal-form").action = `/teams/edit/${team.id}`;

    setValue("name", team.name);
}