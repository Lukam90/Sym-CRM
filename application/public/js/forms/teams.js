const deleteTeam = (button) => {
    $("#deleteTitle").innerHTML = button.dataset.modalTitle;
    $("#deleteForm").action = button.dataset.formAction;
    $("#deleteName").innerHTML = button.dataset.teamName;
    $("#deleteToken").value = button.dataset.token;

    openModal("#deleteModal");
};

const addTeam = (button) => {
    $("#modalTitle").textContent = button.dataset.modalTitle;
    $("#modalForm").action = button.dataset.formAction;
    $("#formToken").value = button.dataset.token;

    openModal("#formModal");
};

const editTeam = (button) => {
    addTeam(button);

    $("#name").value = button.dataset.teamName;
};