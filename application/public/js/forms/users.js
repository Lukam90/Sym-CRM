const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.name;
};

const editModal = (button) => {
    addModal(button);

    $("#role").value = button.dataset.role;
};