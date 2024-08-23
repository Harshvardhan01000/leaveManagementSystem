$(document).ready(function () {
    $.ajax({
        type: "GET",
        url: '/get-individual-attendance/66516086-e13b-41d4-abca-59e9d99aabe8',
        success: function(data) {
            new Chart(document.querySelector('#pieChart'), {
                type: 'pie',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Days',
                        data: data.values,
                        backgroundColor: [
                            'rgb(255, 99, 132)',  
                            'rgb(54, 162, 235)',  
                            'rgb(255, 205, 86)'   
                        ],
                        hoverOffset: 4
                    }]
                }
            });
        }
    });
    $('.dropdown-menu a').click(function (event) {
        event.preventDefault();
        const selectedFilter = $(this).data('value');
        $('#dateRangeFilter').text($(this).text());
        updateChart(selectedFilter);
    });
});
