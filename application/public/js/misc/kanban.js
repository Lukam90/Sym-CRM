getTasks();

async function getTasks() {
    const response = await fetch("/data/kanban.csv");
    const data = await response.text();

    const table = data.split("\n");

    table.forEach(row => {
        const columns = row.split(";");

        const name = columns[0];
        const type = columns[1];
        const status = columns[2];

        $(`#${status}`).innerHTML += `
            <div class="task">
                <p>${name}</p>

                <p class="type">${type}</p>
            </div>
        `;
    });
}