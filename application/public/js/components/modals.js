class Modal {
    static open(id) {
        $(id).classList.add("is-active");
    }

    static close(id, event = null) {
        $(id).classList.remove("is-active");
    
        if (event)  event.preventDefault();
    }
}