$(document).ready(function(){
    $('.sidebar-item').removeClass('active');
    $('#salary').addClass('active');   
});
 //salary chart

 new ApexCharts(document.querySelector("#reportsChart"), {
    series: [{
        name: 'Base Salary',
        data: [30000,30000,30000,32000,32000,32000,32000],
    }, {
        name: 'allowances',
        data: [5000,5000,5000,7000,7000,7000,7000]
    }, {
        name: 'deductions',
        data: [3000,2000,1000,0,5000,1000,0]
    }],
    chart: {
        height: 350,
        type: 'area',
        toolbar: {
            show: false
        },
    },
    markers: {
        size: 4
    },
    colors: ['#4154f1', '#2eca6a', '#ff771d'],
    fill: {
        type: "gradient",
        gradient: {
            shadeIntensity: 1,
            opacityFrom: 0.3,
            opacityTo: 0.4,
            stops: [0, 90, 100]
        }
    },
    dataLabels: {
        enabled: false
    },
    stroke: {
        curve: 'smooth',
        width: 2
    },
    xaxis: {
        type: 'Months',
        categories: ["Jan", "Feb", "Mar", "Apr", "May", "Jun"]
    },
    tooltip: {
        x: {
            format: 'dd/MM/yy HH:mm'
        },
    }
}).render();