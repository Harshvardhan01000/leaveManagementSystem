@extends('welcome')
@section('content')
            <div class="mt-4">
                <div class="container-fluid">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h2>Employee List</h2>
                        <i class="bi bi-person-add fs-1 me-2" id="register"></i>
                    </div>
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
                        <div class="row" id="inputs">
                            <div class="mb-3 col-6">
                                <label for="editFirstName" class="form-label">First Name</label>
                                <input type="text" class="form-control" id="first_name" name="first_name" required>
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
                                <label for="editDepartment" class="form-label">Department</label>
                                <select name="department" id="department" class="form-select"></select>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editDesignation" class="form-label">Designation</label>
                                <input type="text" class="form-control" id="designation" name="designation"
                                    required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editJoiningDate" class="form-label">Joining Date</label>
                                <input type="datetime-local" class="form-control" id="joining_date" name="joining_date"
                                    required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editCurrentSalary" class="form-label">Current Salary</label>
                                <input type="number" class="form-control" id="current_salary" name="current_salary"
                                    min="0" required>
                            </div>
                            <div class="mb-3 col-6">
                                <label for="editProfilePhoto" class="form-label">Profile Photo</label>
                                <input type="file" class="form-control" id="image" name="image">
                            </div>
                        </div>
                        <div class="mb-3 col-6" id="inputPassword">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password">
                        </div>

                        <button type="submit" class="btn btn-primary">Save Changes</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="assets/js/employee.js"></script>
@endsection