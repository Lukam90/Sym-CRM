const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.eventTitle;
};

const editModal = (button) => {
    addModal(button);

    $("#title").value = button.dataset.eventTitle;
    $("#date").value = formatDate(button.dataset.eventDate);
    $("#description").value = button.dataset.eventDescription;

    let types = all("input[name='type']");

    let selectedType = button.dataset.eventType;

    for (let type of types) {
        if (type.value == selectedType) {
            type.checked = true;
        }
    }
};