$(document).ready(function() {
    $('.sidebar-item').removeClass('active');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    // Initialize form validation
    $('#changePasswordForm').validate({
        rules: {
            currentPassword: {
                required: true,
                minlength: 6
            },
            newPassword: {
                required: true,
                minlength: 6
            },
            confirmPassword: {
                required: true,
                minlength: 6,
                equalTo: "#newPassword" // Ensures confirmPassword matches newPassword
            }
        },
        messages: {
            currentPassword: {
                required: "Please enter your current password",
                minlength: "Password must be at least 6 characters long"
            },
            newPassword: {
                required: "Please enter a new password",
                minlength: "Password must be at least 6 characters long"
            },
            confirmPassword: {
                required: "Please confirm your new password",
                minlength: "Password must be at least 6 characters long",
                equalTo: "Passwords do not match"
            }
        },
        submitHandler: function(form) {
            // Perform AJAX request to change password
            $.ajax({
                url: '/change-password', // Adjust this to your route
                type: 'POST',
                data: $(form).serialize(),
                success: function(response) {
                    // Handle success response
                    if(response.status === 'success') {
                        Swal.fire({
                            icon: 'success',
                            title: 'Password Changed',
                            text: response.message
                        });
                    }
                },
                error: function(xhr) {
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message // Display error message from server
                    });
                }
            });
        }
    });
     // Initialize the validation
     $("#profileForm").validate({
        errorClass: 'is-invalid',
        rules: {
            first_name: {
                required: true,
                minlength: 2
            },
            last_name: {
                required: true,
                minlength: 2
            },
            email: {
                required: true,
                email: true
            },
            joiningDate: {
                required: true,
                date: true
            },
            phone_number: {
                required: true,
                digits: true,
                minlength: 10,
                maxlength: 15
            },
            department: {
                required: true
            }
        },
        messages: {
            first_name: {
                required: "Please enter your first name",
                minlength: "First name must be at least 2 characters long"
            },
            last_name: {
                required: "Please enter your last name",
                minlength: "Last name must be at least 2 characters long"
            },
            email: {
                required: "Please enter your email",
                email: "Please enter a valid email address"
            },
            joiningDate: {
                required: "Please select your joining date"
            },
            phone_number: {
                required: "Please enter your phone number",
                digits: "Please enter only digits",
                minlength: "Phone number must be at least 10 digits",
                maxlength: "Phone number cannot exceed 15 digits"
            },
            department: {
                required: "Please select your department"
            }
        },
        submitHandler: function (form) {
            // AJAX request to submit the form
            $.ajax({
                url: '/update-profile',
                type: 'POST',
                data: $(form).serialize(),
                success: function (response) {
                    // Handle success response
                    Swal.fire({
                        icon: 'success',
                        title: 'Data Changed',
                        text: response.message
                    });
                },
                error: function (xhr) {
                    // Handle error response
                    Swal.fire({
                        icon: 'error',
                        title: 'Error',
                        text: xhr.responseJSON.message // Display error message from server
                    });
                }
            });
        }
    });

    
});
