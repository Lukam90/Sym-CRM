const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};

const setModalData = (button, type) => {
    let dataset = button.dataset;

    $(`#${type}Title`).textContent = dataset.modalTitle;
    $(`#${type}Form`).action = dataset.formAction;
    $(`#${type}Token`).value = dataset.token;

    openModal(`#${type}`);
};

const addModal = (button) => setModalData(button, "modal");

const setOptions = (button, name) => {
    let radios = all(`input[name='${name}']`);

    let selectedRadio = button.dataset[name];

    for (let radio of radios) {
        if (radio.value == selectedRadio) {
            radio.checked = true;
        }
    }
};