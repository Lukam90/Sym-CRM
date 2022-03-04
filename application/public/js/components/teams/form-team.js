class TeamForm extends ModalForm {
    static delete(button){
        setToken(button, "delete");

        let id = button.getAttribute("id");
        let name = button.getAttribute("name");

        $("#deleteTitle").textContent = "Suppression d'une équipe";
        $("#deleteForm").action = `/teams/delete/${id}`;
        $("#deleteName").textContent = name;
    }

    static add(button){
        setToken(button, "modal");
    
        $("#modalTitle").textContent = "Ajout d'une équipe";
        $("#modalForm").action = "/teams/new";
    }

    static edit(button){
        setToken(button, "modal");
    
        let id = button.getAttribute("id");
    
        $("#modalTitle").textContent = "Edition d'une équipe";
        $("#modalForm").action = `/teams/edit/${id}`;
    
        setValue(button, "name");
    }
}