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

    let types = all("input[name='type']");

    let selectedType = dataset.type;

    for (let type of types) {
        if (type.value == selectedType) {
            type.checked = true;
        }
    }
};