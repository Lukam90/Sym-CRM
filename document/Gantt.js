// Setup

const data = {
    labels: ["Task A", "Task B", "Task C", "Task D", "Task E"],
    datasets: [
        {
            label: "Projected Time",
            data: [
                ["2021-01-01", "2021-04-01"],
                ["2021-04-01", "2021-07-01"],
                ["2021-03-01", "2021-05-31"],
                ["2021-06-01", "2021-09-30"],
                ["2021-10-01", "2021-12-31"],
            ],
            taskCompleted: [100, 100, 100, 100, 100],
            backgroundColor: "rgba(0, 0, 0, 0.2)",
            borderColor: "rgba(0, 0, 0, 1)",
            borderWidth: 1,
            borderSkipped: false
        },
        {
            label: "Actual Time",
            data: [
                ["2021-01-01", "2021-03-25"],
                ["2021-04-01", "2021-07-15"],
                ["2021-03-01", "2021-05-31"],
                ["2021-06-01", "2021-10-30"],
                ["2021-10-01", "2021-12-31"],
            ],
            taskCompleted: [100, 80, 75, 100, 100],
            backgroundColor: "rgba(255, 26, 104, 0.2)",
            borderColor: "rgba(255, 26, 104, 1)",
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
                filter: (tooltipItem) => {
                    return tooltipItem.datasetIndex === 1;
                },
                yAlign: "bottom",
                callbacks: {
                    label: (context) => {
                        const taskPercentage = context.dataset.taskCompleted[context.dataIndex];

                        const completedData = new Date(context.parsed.x);
                        const cleanedData = completedData.getFullYear() + "/" + (completedData.getMonth() + 1) + "/" + completedData.getDate();

                        const realTime = new Date(data.datasets[1].data[context.dataIndex][1]);
                        const projectedTime = new Date(data.datasets[0].data[context.dataIndex][1]);

                        const dateDifference = realTime - projectedTime;

                        let delay = Math.floor(dateDifference / (1000 * 60 * 60 * 24));

                        delay = delay < 0 ? 0 : delay;

                        const response = taskPercentage === 100 ?
                            `Completed Date: ${cleanedDate}, Total Delay of ${delay} Days` :
                            `Ongoing Project: ${cleanedDate}`;

                        return response;
                    }
                }
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
                min: "2021-01-01",
                position: "top",
                type: "time",
                time: {
                    unit: "quarter"
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
