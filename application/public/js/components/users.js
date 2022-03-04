const deleteUser = (button) => {
    setToken(button, "delete");

    let id = button.getAttribute("id");
    let name = button.getAttribute("name");

    $("#deleteTitle").textContent = "Suppression d'un utilisateur";
    $("#deleteForm").action = `/users/delete/${id}`;
    $("#deleteName").textContent = name;
};

const addContact = (button) => {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un utilisateur";
    $("#modalForm").action = "/users/new";
};

const editUser = (button) => {
    setToken(button, "modal");

    let id = button.getAttribute("id");

    $("#modalTitle").textContent = "Edition d'un utilisateur";
    $("#modalForm").action = `/users/edit/${id}`;

    setValue(button, "name");
    setValue(button, "address");
    setValue(button, "phone");
    setValue(button, "email");
    setValue(button, "website");

    setOptions(button, "type");
    setOptions(button, "role");
};