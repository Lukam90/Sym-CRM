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

const buildTable = (events) => {
    const table = $("#table");

    table.innerHTML = "";

    for (let event of events) {
        let row = `
            <tr>
                <td>${event.id}</td>
                <td>${event.title}</td>
                <td>${event.type}</td>
                <td>${event.date}</td>
                <td>${event.description}</td>

                <td>
                    <a href="#" class="button is-info">
                        <i class="fa fa-eye"></i>
                    </a>
                </td>

                <td>
                    <button
                        class="button is-success"
                        data-modal-title="Edition d'un événement"
                        data-form-action="/events/edit/${event.id}"
                        data-title="${event.title}"
                        data-type="${event.type}"
                        data-date="${formatDate(event.date)}"
                        data-description="${event.description}"
                        data-token="{{ csrf_token('edit') }}"
                        onclick="editModal(this)">
                        <i class="fa fa-pencil"></i>
                    </button>
                </td>

                <td>
                    <button
                        class="button is-danger"
                        data-modal-title="Suppression d'un événement"
                        data-form-action="/events/delete/${event.id}"
                        data-title="${event.title}"
                        data-token="{{ csrf_token('delete') }}"
                        onclick="deleteModal(this)">
                        <i class="fa fa-times"></i>
                    </button>
                </td>
            </tr>
        `;

        table.innerHTML += row;
    }
};

const getEvents = async (column, order) => {
    let response = await fetch(`/events/sort/${column}/${order}`);
    let events = await response.json();

    return events;
};

const sortColumn = async (tableHeader) => {
    let column = tableHeader.dataset.column;
    let order = tableHeader.dataset.order;

    let events = await getEvents(column, order);

    console.log(events[0].date);

    let text = tableHeader.innerHTML;
    text = text.substring(0, text.length - 1);

    if (order == "desc") {
        tableHeader.dataset.order = "asc";

        events = events.sort((a,b) => a[column] > b[column] ? 1 : -1);

        text += '&#9660';
    } else {
        tableHeader.dataset.order = "desc";

        events = events.sort((a,b) => a[column] < b[column] ? 1 : -1);

        text += '&#9650';
    }

    tableHeader.innerHTML = text;

    buildTable(events);
};