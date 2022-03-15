/**
 * Opens a modal window
 * 
 * @param {string} id The modal's ID
 */
const openModal = (id) => $(id).classList.add("is-active");

/**
 * Closes a modal window
 * 
 * @param {string} id
 * @param {HTMLButtonElement} button
 */
const closeModal = (id, button = null) => {
    $(id).classList.remove("is-active");

    if (button) button.preventDefault();
}

/**
 * Gets JSON data from a line
 * 
 * @param {HTMLButtonElement} button
 * 
 * @returns JSON 
 */
const getData = (button) => JSON.parse(button.getAttribute("data"));

/**
 * Sets a field value
 * 
 * @param {string} id
 * @param {string} newValue
 */
const setValue = (id, newValue) => $(`#${id}`).value = newValue;

/**
 * Sets options in a select or radio buttons range
 * 
 * @param {string} name
 * @param {string} value
 */
const setOptions = (name, value) => {
    let radios = all(`input[name='${name}']`);

    let selectedRadio = value;

    for (let radio of radios) {
        if (radio.value == selectedRadio) {
            radio.checked = true;
        }
    }
}