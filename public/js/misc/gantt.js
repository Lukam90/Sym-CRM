// Data

const values = [
    ["Conception", "2022-02-07", "2022-02-08", 100],
    ["Composants", "2022-02-08", "2022-02-09", 100],
    ["Pages", "2022-02-09", "2022-02-11", 90],
    ["Utilisateurs", "2022-02-11", "2022-03-09", 50],
    ["Equipes", "2022-02-11", "2022-03-09", 50],
    ["Evénements", "2022-02-11", "2022-03-09", 50],
    ["Contacts", "2022-02-11", "2022-03-09", 50],
];

let tasks = [],
    dates = [],
    percentages = [];

for (let line of values) {
    tasks.push(line[0]);
    dates.push([line[1], line[2]]);
    percentages.push(line[3]);
}

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
                max: "2022-03-10",
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
