const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event) => { 
    $(id).classList.remove("is-active");

    event.preventDefault();
};