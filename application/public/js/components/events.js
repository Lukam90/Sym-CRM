const deleteEvent = (button) => {
    setToken(button, "delete");

    let id = button.getAttribute("id");
    let name = button.getAttribute("name");

    $("#deleteTitle").textContent = "Suppression d'un événement";
    $("#deleteForm").action = `/events/delete/${id}`;
    $("#deleteName").textContent = name;
};

const addEvent = (button) => {
    setToken(button, "modal");

    $("#modalTitle").textContent = "Ajout d'un événement";
    $("#modalForm").action = "/events/new";
};

const editEvent = (button) => {
    setToken(button, "modal");

    let id = button.getAttribute("id");

    $("#modalTitle").textContent = "Edition d'un événement";
    $("#modalForm").action = `/events/edit/${id}`;

    setValue(button, "name");
    setValue(button, "address");
    setValue(button, "phone");
    setValue(button, "email");
    setValue(button, "website");

    setOptions(button, "type");
    setOptions(button, "role");
};