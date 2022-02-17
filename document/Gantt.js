// Data

let tasks = [],
    dates = [],
    percentages = [];

getData();

async function getData() {
    const response = await fetch("Gantt.csv");
    const data = await response.text();

    const table = data.split("\n").slice(1);

    table.forEach(row => {
        const columns = row.split(";");

        const task = columns[0];
        const start = columns[1];
        const end = columns[2];
        const completed = columns[3];

        tasks.push(task);
        dates.push([start, end]);
        percentages.push(completed);
    });
}

console.log(tasks);
console.log(dates);
console.log(percentages);

// Setup

const data = {
    labels: tasks,
    datasets: [
        {
            label: "Nombre de jours",
            data: dates,
            taskCompleted: percentages,
            backgroundColor: "rgba(255, 26, 104, 0.2)",
            borderColor: "rgba(0, 0, 0, 1)",
            borderWidth: 1,
            borderSkipped: false
        },
    ],
};

// Config

const config = {
    type: "bar",
    data,
    options: {
        plugins: {
            tooltip: {
                enabled: false
            },
            datalabels: {
                formatter: (value, context) => {
                    const taskPercentage = context.dataset.taskCompleted[context.dataIndex];

                    return `${taskPercentage}%`;
                }
            }
        },
        indexAxis: "y",
        scales: {
            x: {
                offset: false,
                min: "2022-02-07",
                max: "2022-03-14",
                position: "top",
                type: "time",
                time: {
                    unit: "day"
                },
                ticks: {
                    align: "start"
                },
                grid: {
                    borderDash: [5, 5]
                }
            },
            y: {
                beginAtZero: true,
            },
        },
    },
    plugins: [ChartDataLabels]
};

// Render init block

const myChart = new Chart(document.getElementById("myChart"), config);
