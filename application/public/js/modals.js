const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};

const deleteModal = (button) => {
    const dataSet = button.dataset;

    $("#deleteName").innerHTML = dataSet.name;
    $("#deleteTitle").innerHTML = dataSet.title;
    $("#deleteForm").action = `/${dataSet.type}/delete/${dataSet.id}`;
    $("#deleteToken").value = dataSet.token;

    openModal("#deleteModal");
};