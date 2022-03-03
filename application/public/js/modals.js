const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};

const setToken = (button, type) => {
    let token = button.dataset.token;

    $(`#${type}Token`).value = token;

    openModal(`#${type}`);
};

const setOptions = (object, name) => {
    let radios = all(`input[name='${name}']`);

    let selectedRadio = object[name];

    for (let radio of radios) {
        if (radio.value == selectedRadio) {
            radio.checked = true;
        }
    }
};