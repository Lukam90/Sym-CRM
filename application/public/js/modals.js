const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};