// jQuery-like Selector

const $ = (value) => document.querySelector(value);

// Columns

const colTodo = $("#todo");
const colInProgress = $("#inprogress");
const colTesting = $("#testing");
const colDone = $("#done");

/*
<div class="task">
    <span>Task 1</span>
</div>
*/

let tasks = [];

getData();

async function getData() {
    const response = await fetch("Kanban.csv");
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

        //tasks.push(name);
    });
}