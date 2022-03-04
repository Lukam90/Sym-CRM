class ContactForm extends ModalForm {
    static deleteContact(button) {
        setToken(button, "delete");
    
        let id = button.getAttribute("id");
        let name = button.getAttribute("name");
    
        $("#deleteTitle").textContent = "Suppression d'un contact";
        $("#deleteForm").action = `/contacts/delete/${id}`;
        $("#deleteName").textContent = name;
    }

    static addContact(button) {
        setToken(button, "modal");
    
        $("#modalTitle").textContent = "Ajout d'un contact";
        $("#modalForm").action = "/contacts/new";
    }

    static editContact(button) {
        setToken(button, "modal");
    
        let id = button.getAttribute("id");
    
        $("#modalTitle").textContent = "Edition d'un contact";
        $("#modalForm").action = `/contacts/edit/${id}`;
    
        setValue(button, "name");
        setValue(button, "address");
        setValue(button, "phone");
        setValue(button, "email");
        setValue(button, "website");
    
        setOptions(button, "type");
        setOptions(button, "role");
    }
}