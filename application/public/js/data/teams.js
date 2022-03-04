function _delete(button) {
    setToken(button, "delete");

    let team = getData(button);

    $("#deleteTitle").textContent = "Suppression d'une équipe";
    $("#deleteForm").action = `/teams/delete/${team.id}`;
    $("#deleteName").textContent = team.name;
}

function _add(button) {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'une équipe";
    $("#modalForm").action = "/teams/new";
}

function _edit(button) {
    setToken(button, "modal");

    let team = getData(button);

    $("#modalTitle").textContent = "Edition d'une équipe";
    $("#modalForm").action = `/teams/edit/${team.id}`;

    setValue("name", team.name);
}