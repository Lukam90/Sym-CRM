function openModal(id) {
    $(id).classList.add("is-active");
}

function closeModal(id, event = null) {
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
}

function setValue(button, name) {
    $(`#${name}`).value = button.getAttribute(name);
}

function setToken(button, type) {
    let token = button.getAttribute("token");

    $(`#${type}Token`).value = token;

    openModal(`#${type}`);
}

function setOptions(button, name) {
    let radios = all(`input[name='${name}']`);

    let selectedRadio = button.getAttribute(name);

    for (let radio of radios) {
        if (radio.value == selectedRadio) {
            radio.checked = true;
        }
    }
}