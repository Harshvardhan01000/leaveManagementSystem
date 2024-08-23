function getEmployeeData() {
    $.ajax({
        type: 'GET',
        url: '/employee',
        success: function (data) {

            $('tbody').empty();
            data.forEach(element => {
                const formattedSalary = element.current_salary.toLocaleString('en-US', { minimumFractionDigits: 2, maximumFractionDigits: 2 });
                const joiningDate = new Date(element.joining_date);
                const formattedDate = joiningDate.toLocaleDateString('en-US', { year: 'numeric', month: 'short', day: 'numeric' });
                $('tbody').append(
                    `<tr>
                       <td>${element.user_details.first_name} ${element.user_details.last_name}</td>
                       <td>${element.user_details.email}</td>
                       <td>${element.user_details.phone_number}</td>
                       <td>${element.designation}</td>
                       <td>${element.department_details.department_name}</td>
                       <td>${formattedDate}</td>
                       <td>$${formattedSalary}</td>
                       <td><i class="bi bi-pencil-square" id='edit' data-id="${element.id}"></i></td>
                       <td><i class="bi bi-eye" id='view' data-id="${element.id}"></i></td>
                       <td><i class="bi bi-trash3" id='delete' data-id="${element.id}"></i></td>
                   </tr>`
                );
            });

        }
    })
}
function getDepartment(employeeData = null) {
    $.ajax({
        type: 'GET',
        url: 'fetch-department',
        success: function (data) {
            if (data) {
                $('#department').empty();
                $('#department').append(`<option val="" style="display:none">select</option>`);
                data.forEach(element => {
                    if (employeeData && employeeData.department_details.id == element.id) {
                        $('#department').append(
                            `<option value=${element.id} selected>${element.department_name}</option>`
                        );

                        console.log($('#department').val());
                    } else {
                        $('#department').append(
                            `<option value=${element.id}>${element.department_name}</option>`
                        );
                    }

                });
            }
        }
    });
}

$(document).ready(function () {
    $('#employeelist a.nav-link').removeClass('collapsed');
    $('#sidebar-nav li.nav-item:not(#employeelist) a.nav-link').addClass('collapsed');
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    getEmployeeData();
    $(document).on('click', '#edit', function () {
        $.ajax({
            type: "GET",
            url: `/employee/${$(this).attr('data-id')}/edit`,
            success: function (data) {
                $('#editEmployeeForm').trigger('reset');
                const joinDate = new Date(data.joining_date);

                const formattedJoinDate = `${joinDate.getFullYear()}-${String(joinDate.getMonth()
                    + 1).padStart(2, '0')}-${String(joinDate.getDate()).padStart(2, '0')}T${String(joinDate.getHours()).padStart(2, '0')}:${String(joinDate.getMinutes()).padStart(2, '0')}`;


                $('#id').val(data.id);
                $('#_method').val('put');
                $('#first_name').val(data.user_details.first_name);
                $('#last_name').val(data.user_details.last_name);
                $('#email').val(data.user_details.email);
                $('#phone_number').val(data.user_details.phone_number);
                $('#joining_date').val(formattedJoinDate);
                $('#current_salary').val(data.current_salary);
                $('#designation').val(data.designation);
                getDepartment(data);
            }
        });
        $('#inputPassword').hide();
        $('#editEmployeeForm').trigger('reset');
        $('#editEmployeeModal').modal('show');
    });
    $(document).on('click', '#view', function () {

    });
    $(document).on('click', '#delete', function () {
        $.ajax({
            type: 'delete',
            url: `/employee/${$(this).attr('data-id')}`,
            success: function ($data) {
                $('tbody').empty();
                getEmployeeData();
            }
        });
    });
    $('#editEmployeeForm').on('submit', function (e) {
        formData = new FormData(this);
        urlLink = ($('#_method').val() == "put") ? `/employee/${$('#id').val()}` : '/employee';
        e.preventDefault();
        $.ajax({
            type: 'post',
            url: urlLink,
            data: formData,
            dataType: 'JSON',
            contentType: false,
            cache: false,
            processData: false,
            success: function (data) {
                if (data) {
                    getEmployeeData()
                }
                $('#editEmployeeForm').trigger('reset');
                $('#editEmployeeModal').modal('hide');
            }
        });
    });
    $('#register').on('click', function () {
        $('#editEmployeeForm').trigger('reset');
        $('#editEmployeeModal').modal('show');
        $('#inputPassword').show();
        $('#_method').val('post')
        getDepartment();
    });
});