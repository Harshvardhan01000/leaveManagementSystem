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
                    'rgb(54, 162, 235)',
                    'rgb(255, 205, 86)',
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
                    'rgb(129, 212, 250)',
                    'rgb(225, 245, 254)',
                ],
                hoverOffset: 4
            }]
        }
    });
});
$(document).ready(function(){
    $('#dashboard a.nav-link').removeClass('collapsed');
    $('#sidebar-nav li.nav-item:not(#dashboard) a.nav-link').addClass('collapsed');

});