// Pie Chart
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#pieChart'), {
        type: 'pie',
        data: {
            labels: [
                'present',
                'absent',
                
            ],
            datasets: [{
                label: 'employee',
                data: [300, 100],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 4
            }]
        }
    });
});

// <!-- Doughnut Chart -->
document.addEventListener("DOMContentLoaded", () => {
    new Chart(document.querySelector('#doughnutChart'), {
        type: 'doughnut',
        data: {
            labels: [
                'paid',
                'pending',
                
            ],
            datasets: [{
                label: 'employee',
                data: [300, 50],
                backgroundColor: [
                    'rgb(255, 99, 132)',
                    'rgb(54, 162, 235)',
                ],
                hoverOffset: 4
            }]
        }
    });
});