const addTeam = (button) => {
    $("#modalForm").action = "/teams/new";

    $("#formToken").value = button.dataset.token;

    openModal("#formModal");
};

const editTeam = (button) => {
    const dataSet = button.dataset;

    $("#modalForm").action = `/teams/edit/${dataSet.id}`;

    $("#formToken").value = dataSet.token;
    $("#name").value = dataSet.name;

    openModal("#formModal");
};