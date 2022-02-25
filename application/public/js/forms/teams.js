const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.teamName;
}

const editModal = (button) => {
    addModal(button);

    $("#name").value = button.dataset.teamName;
};