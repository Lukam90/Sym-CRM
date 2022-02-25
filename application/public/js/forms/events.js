const editModal = (button) => {
    addModal(button);

    $("#title").value = button.dataset.eventTitle;
    $("#type").value = button.dataset.eventType;
    $("#date").value = button.dataset.eventDate;
    $("#description").value = button.dataset.eventDescription;
};