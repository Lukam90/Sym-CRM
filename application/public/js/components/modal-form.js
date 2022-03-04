class ModalForm extends Modal {
    static setValue(button, name) {
        $(`#${name}`).value = button.getAttribute(name);
    }

    static setToken(button, type) {
        let token = button.getAttribute("token");
    
        $(`#${type}Token`).value = token;
    
        openModal(`#${type}`);
    }

    static setOptions(button, name) {
        let radios = all(`input[name='${name}']`);
    
        let selectedRadio = button.getAttribute(name);
    
        for (let radio of radios) {
            if (radio.value == selectedRadio) {
                radio.checked = true;
            }
        }
    }
}