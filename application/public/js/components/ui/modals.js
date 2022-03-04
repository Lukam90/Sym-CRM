function openModal(id) {
    $(id).classList.add("is-active");
}

function closeModal(id, event = null) {
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
}