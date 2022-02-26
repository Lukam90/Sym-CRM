const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.eventTitle;
};

const editModal = (button) => {
    addModal(button);

    let dataset = button.dataset;

    $("#title").value = dataset.title;
    $("#date").value = formatDate(dataset.date);
    $("#description").value = dataset.description;

    setOptions(button, "type");
};