
$(document).ready(function() {
    $('.sidebar-item').removeClass('active');
    $('#dashboard').addClass('active');  

     // Initialize validation on the holidayForm
     $("#holidayForm").validate({
        errorClass: "invalid-feedback",
        validClass: "valid-feedback",
        errorElement: "div",
        highlight: function(element, errorClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function(element, errorClass) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function(error, element) {
            if (element.prop("type") === "radio" || element.prop("type") === "checkbox") {
                error.insertAfter(element.parent());
            } else {
                error.insertAfter(element);
            }
        },
        rules: {
            holidayName: "required",
            holidayDate: "required",
            holidayDescription: "required"
        },
        messages: {
            holidayName: "Please enter the holiday name.",
            holidayDate: "Please select the holiday date.",
            holidayDescription: "Please provide a brief description."
        }
    });

    
        // Pie chart
        new Chart(document.getElementById("chartjs-dashboard-pie"), {
            type: "pie",
            data: {
                labels: ["present", "adsent"],
                datasets: [{
                    data: [110, 30],
                    backgroundColor: [
                        window.theme.primary,
                        window.theme.danger
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });

        // Pie chart
        new Chart(document.getElementById("salary-chart"), {
            type: "pie",
            data: {
                labels: ["paid", "pending"],
                datasets: [{
                    data: [110, 30],
                    backgroundColor: [
                        window.theme.success,
                        window.theme.warning
                    ],
                    borderWidth: 5
                }]
            },
            options: {
                responsive: !window.MSInputMethodContext,
                maintainAspectRatio: false,
                legend: {
                    display: false
                },
                cutoutPercentage: 75
            }
        });

        var date = new Date(Date.now() - 5 * 24 * 60 * 60 * 1000);
        var defaultDate = date.getUTCFullYear() + "-" + (date.getUTCMonth() + 1) + "-" + date.getUTCDate();
        document.getElementById("datetimepicker-dashboard").flatpickr({
            inline: true,
            prevArrow: "<span title=\"Previous month\">&laquo;</span>",
            nextArrow: "<span title=\"Next month\">&raquo;</span>",
            defaultDate: defaultDate
        });
});