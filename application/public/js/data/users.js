function _delete(button) {
    setToken(button, "delete");

    let user = getData(button);

    $("#deleteTitle").textContent = "Suppression d'un utilisateur";
    $("#deleteForm").action = `/users/delete/${user.id}`;
    $("#deleteName").textContent = user.fullName;
}

function _edit(button) {
    setToken(button, "modal");

    let user = getData(button);

    $("#modalTitle").textContent = "Edition d'un utilisateur";
    $("#modalForm").action = `/users/edit/${user.id}`;
    $("#modalName").textContent = user.fullName;

    setOptions("role", user.role);
}