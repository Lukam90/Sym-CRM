const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.name;
};

const editModal = (button) => {
    addModal(button);

    let dataset = button.dataset;

    $("#name").value = dataset.name;
    $("#address").value = dataset.address;
    $("#phone").value = dataset.phone;
    $("#email").value = dataset.email;
    $("#website").value = dataset.website;

    setOptions(button, "type");
    setOptions(button, "role");
};