const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};

const setModalData = (button, type) => {
    $(`#${type}Title`).textContent = button.dataset.modalTitle;
    $(`#${type}Form`).action = button.dataset.formAction;
    $(`#${type}Token`).value = button.dataset.token;

    openModal(`#${type}`);
}

const addModal = (button) => setModalData(button, "modal");