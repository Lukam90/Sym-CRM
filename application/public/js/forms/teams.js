const deleteTeam = (button) => {
    const dataSet = button.dataset;

    $("#deleteTitle").innerHTML = dataSet.modalTitle;
    $("#deleteForm").action = `/teams/delete/${dataSet.teamId}`;
    $("#deleteName").innerHTML = dataSet.teamName;
    $("#deleteToken").value = dataSet.token;

    openModal("#deleteModal");
};

/*
const addTeam = (button) => {
    const dataSet = button.dataset;

    $("#modalTitle").textContent = dataSet.title;
    $("#modalForm").action = dataSet.action;
    $("#formToken").value = dataSet.token;

    openModal("#formModal");
};

const editTeam = (button) => {
    addModal(button);

    $("#name").value = button.dataset.name;
};
*/