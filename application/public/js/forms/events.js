const editTeam = (button) => {
    addModal(button);

    $("#name").value = button.dataset.name;
};