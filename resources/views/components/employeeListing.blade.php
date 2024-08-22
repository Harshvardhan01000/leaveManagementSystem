<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="assets/css/style.css" rel="stylesheet">

</head>

<body>
    @include('components.navbar')
    <div class="row">
        <div class="col-2">
            @include('components.sidebar')
        </div>
        <div class="col-10 mt-5">
            <div class="mt-4">
                <div class="container-fluid">
                    <h2 class="mb-4">Employee List</h2>
                    <div class="table-responsive px-2">
                        <table class="table table-striped table-hover align-middle rounded-2 text-center">
                            <thead class="thead-light">
                                <tr>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Phone Number</th>
                                    <th>Designation</th>
                                    <th>Department</th>
                                    <th>Joining Date</th>
                                    <th>Current Salary</th>
                                    <th colspan="3">Action</th>

                                </tr>
                            </thead>
                            <tbody>
                                <!-- Data Rows will be appended here -->
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div class="modal fade" id="editEmployeeModal" tabindex="-1" aria-labelledby="editEmployeeModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl"> 
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="editEmployeeModalLabel">Edit Employee</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="editEmployeeForm" action="javascript:;" method="POST" enctype='multipart/form-data'>
                        <input type="hidden" id="id" value="">
                        <input type="hidden" id="_method" name="_method" value="post">
                        <div class="row">
                            <div class="mb-3 col-6">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name"
                                    required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editLastName" class="form-label">Last Name</label>
                                <input type="text" class="form-control" id="last_name" name="last_name" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editEmail" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editPhoneNumber" class="form-label">Phone Number</label>
                                <input type="text" class="form-control" id="phone_number" name="phone_number"
                                    required>
                            </div>

                            <div class="mb-3 col-6">
                                <label for="editDesignation" class="form-label">Designation</label>
                                <select name="department" id="department" class="form-select"></select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editJoiningDate" class="form-label">Joining Date</label>
                                <input type="datetime-local" class="form-control" id="joining_date"
                                    name="joining_date" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editCurrentSalary" class="form-label">Current Salary</label>
                                <input type="number" class="form-control" id="current_salary" name="current_salary"
                                    min="0" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editProfilePhoto" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" id="image" name="image"
                                    >
                            </div>
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="assets/js/employee.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
