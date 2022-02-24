const openModal = (id) => $(id).classList.add("is-active");

const closeModal = (id, event = null) => { 
    $(id).classList.remove("is-active");

    if (event)  event.preventDefault();
};

const deleteModal = (button) => {
    const dataSet = button.dataset;

    const id = dataSet.id;
    const name = dataSet.name;
    const type = dataSet.type;
    const title = dataSet.title;
    const token = dataSet.token;

    $("#deleteName").innerHTML = name;
    $("#deleteTitle").innerHTML = title;
    $("#deleteForm").action = `/${type}/delete/${id}`;
    $("#deleteToken").value = token;

    openModal("#deleteModal");
}