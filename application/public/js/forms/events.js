const deleteModal = (button) => {
    setModalData(button, "delete");

    $("#deleteName").textContent = button.dataset.eventTitle;
};

const editModal = (button) => {
    addModal(button);

    let dataset = button.dataset;

    $("#title").value = dataset.title;
    $("#date").value = formatDate(dataset.date);
    $("#description").value = dataset.description;

    setOptions(button, "type");
};

const sort = (field, order) => {
    let xmlHttp = new XMLHttpRequest();

    xmlHttp.onreadystatechange = function () {
        //console.log(this.readyState)

        if (this.readyState == 4 && this.status == 200) {
            console.log("Ajax Events OK");

            console.log(this.responseText);
        } else {
            console.log("Ajax Events Errors");
        }
    };

    xmlHttp.open("GET", `/events?field=${field}&order=${order}`, true); // true
    xmlHttp.send();
};