function openModal(id) {
    $(id).classList.add("is-active");
}

function closeModal(id, event = null) {
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
}

function getData(button) {
    return JSON.parse(button.getAttribute("data"));
}

function setValue(name, newValue) {
    $(`#${name}`).value = newValue;
}

function setToken(button, type) {
    let token = button.getAttribute("token");

    $(`#${type}Token`).value = token;

    openModal(`#${type}`);
}

function setOptions(name, value) {
    let radios = all(`input[name='${name}']`);

    let selectedRadio = value;

    console.log(selectedRadio);

    for (let radio of radios) {
        if (radio.value == selectedRadio) {
            radio.checked = true;
        }
    }
}