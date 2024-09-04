
$(document).ready(function () {
    $('.sidebar-item').removeClass('active');
    $('#dashboard').addClass('active');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    // Initialize validation on the holidayForm
    $("#holidayForm").validate({
        errorClass: "invalid-feedback",
        validClass: "valid-feedback",
        errorElement: "div",
        highlight: function (element, errorClass) {
            $(element).addClass('is-invalid');
        },
        unhighlight: function (element, errorClass) {
            $(element).removeClass('is-invalid');
        },
        errorPlacement: function (error, element) {
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
        },
        errorPlacement: function(error, element) {
            error.insertAfter(element);  // Place error after the input field
        }
    });

    // Pie chart attendance
    new Chart(document.getElementById("chartjs-dashboard-pie"), {
        type: "pie",
        data: {
            labels: ["adsent", "present"],
            datasets: [{
                data: [todayPresentCount, absentCount],
                backgroundColor: [
                    window.theme.danger,
                    window.theme.primary
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

    // Pie chart salary
    new Chart(document.getElementById("salary-chart"), {
        type: "pie",
        data: {
            labels: ["paid", "pending"],
            datasets: [{
                data: [salaryCount.paid_count, salaryCount.pending_count],
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

    // Convert holiday dates to Date objects
    const holidayDates = holidays.map(date => new Date(date));

    // Function to generate weekends for a given year
    function getWeekends(year) {
        const weekends = [];
        let date = new Date(year, 0, 1); // Start of the year

        while (date.getFullYear() === year) {
            if (date.getDay() === 0 || date.getDay() === 6) { // Sunday or Saturday
                weekends.push(new Date(date));
            }
            date.setDate(date.getDate() + 1);
        }

        return weekends;
    }

    // Get weekends for the current year (or specify another year)
    const currentYear = new Date().getFullYear();
    const weekendDates = getWeekends(currentYear);

    // Initialize Flatpickr with custom onDayCreate callback
    const fp = document.getElementById("datetimepicker-dashboard").flatpickr({
        inline: true,
        prevArrow: "<span title=\"Previous month\">&laquo;</span>",
        nextArrow: "<span title=\"Next month\">&raquo;</span>",
        defaultDate: new Date(), // Set default date to today
        onDayCreate: function (dObj, dStr, fp, dayElem) {
            // Convert flatpickr day element's date to a string
            const dateStr = dayElem.dateObj.toISOString().split('T')[0];

            // Check if the day is a holiday or a weekend
            const isHoliday = holidayDates.some(holiday => holiday.toISOString().split('T')[0] === dateStr);
            const isWeekend = weekendDates.some(weekend => weekend.toISOString().split('T')[0] === dateStr);

            // Apply custom styling for holidays or weekends
            if (isHoliday || isWeekend) {
                dayElem.style.color = 'red';
            }
        }
    });

    // Mark today's date when the calendar is loaded
    const today = new Date();
    fp.setDate(today, true); // Set the current date and open the calendar

    $('#holidayForm').on('submit', function(e) {
        e.preventDefault(); // Prevent the default form submission

        // Create a FormData object from the form
        var formData = new FormData(this);

        $.ajax({
            url: '/create-holiday', // Your endpoint for creating a holiday
            type: 'POST',
            data: formData,
            processData: false, // Prevent jQuery from processing the data
            contentType: false, // Prevent jQuery from setting the content type
            success: function(data) {
                // Show a success message using SweetAlert2
                Swal.fire({
                    icon: 'success',
                    title: 'Success!',
                    text: data.message, // Display the success message
                    confirmButtonText: 'OK'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Optionally, clear the form
                        $('#holidayForm')[0].reset();

                        // Refresh the page
                        window.location.reload();
                    }
                });
            },
            error: function(xhr) {
                // Show an error message using SweetAlert2
                Swal.fire({
                    icon: 'error',
                    title: 'Error!',
                    text: 'An error occurred: ' + xhr.responseText, // Display the error message
                    confirmButtonText: 'OK'
                });
            }
        });
    });
    let date = new Date();
    let day = String(date.getDate()).padStart(2, '0');
    let month = String(date.getMonth() + 1).padStart(2, '0'); // Months are zero-based
    let year = date.getFullYear();
    let minDate = year + '-' + month + '-' + day;
    $('#holidayDate').attr('min', minDate);
});