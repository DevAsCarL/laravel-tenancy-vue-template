export const lineChartOptions = {
    legend: {
        display: false
    },
    responsive: true,
    maintainAspectRatio: false,
    elements: {
        line: {
            tension: 0
        }
    },
    scales: {
        x: {
            gridLines: {
                display: true,
                lineWidth: 1,
                color: "rgba(0,0,0,0.1)",
                drawBorder: false
            },
            ticks: {
                beginAtZero: true,
                // stepSize: 5,
                // min: 50,
                // max: 70,
                // padding: 20
            }
        },
        y: {
            gridLines: {
                display: true,
                lineWidth: 1,
                color: "rgba(0,0,0,0.1)",
                drawBorder: false
            }
        }
    }
};
