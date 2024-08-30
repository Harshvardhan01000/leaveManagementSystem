<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin & Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords" content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/icons/icon-48x48.png') }}" />
    <link rel="canonical" href="https://demo-basic.adminkit.io/" />
    <title>User Profile - Leave Management System</title>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>
</head>

<body>
    <div class="wrapper">
        @include('user.sidebar')
        <div class="main">
            @include('component.navbar')

            <main class="content">
                <div class="container-fluid p-0">
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="h3 d-inline align-middle">Profile</h1>
                    </div>

                    <div class="row">
                        <div class="col-md-4 col-lg-3">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Profile Details</h5>
                                </div>
                                <div class="card-body text-center">
                                    <img src="{{ asset('UserProfile/userlogo.png') }}" alt="Christina Mason"
                                        class="img-fluid rounded-circle mb-2" width="128" height="128" />
                                    <h5 class="card-title mb-0">Christina Mason</h5>
                                    <div class="text-muted mb-2">Web Developer</div>

                                    <div>
                                        <a class="btn btn-primary btn-sm" href="#">Follow</a>
                                        <a class="btn btn-primary btn-sm" href="#"><span
                                                data-feather="message-square"></span> Message</a>
                                    </div>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <h5 class="h6 card-title">Skills</h5>
                                    <a href="#" class="badge bg-primary me-1 my-1">HTML</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">JavaScript</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Sass</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Angular</a>
                                    <a href="#" class="badge bg-primary me-1 my-1">Vue</a>
                                </div>
                                <hr class="my-0" />
                                <div class="card-body">
                                    <h5 class="h6 card-title">About</h5>
                                    <ul class="list-unstyled mb-0">
                                        <li class="mb-1"><span data-feather="home" class="feather-sm me-1"></span>
                                            Lives in <a href="#">San Francisco, SA</a></li>

                                        <li class="mb-1"><span data-feather="briefcase"
                                                class="feather-sm me-1"></span> Works at <a href="#">GitHub</a>
                                        </li>
                                        <li class="mb-1"><span data-feather="map-pin" class="feather-sm me-1"></span>
                                            From <a href="#">Boston</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="col-md-8 col-lg-9">
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Personal Information</h5>
                                </div>
                                <div class="card-body">
                                    <form id="profileForm">
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="firstName" class="form-label">First Name</label>
                                                    <input type="text" class="form-control" id="firstName" name="firstName" value="John" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="lastName" class="form-label">Last Name</label>
                                                    <input type="text" class="form-control" id="lastName" name="lastName" value="Snow" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="email" class="form-label">Email</label>
                                                    <input type="email" class="form-control" id="email" name="email" value="John@gmail.com" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="phoneNumber" class="form-label">Phone Number</label>
                                                    <input type="text" class="form-control" id="phoneNumber" name="phoneNumber" value="123456879" required>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="mb-3">
                                                    <label for="joiningDate" class="form-label">Joining Date</label>
                                                    <input type="date" class="form-control" id="joiningDate" name="joiningDate" value="2024-08-29" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="currentSalary" class="form-label">Current Salary</label>
                                                    <input type="number" class="form-control" id="currentSalary" name="currentSalary" value="30000" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="department" class="form-label">Department</label>
                                                    <input type="text" class="form-control" id="department" name="department" value="Laravel" required>
                                                </div>
                                            </div>
                                        </div>
                                        <button type="submit" class="btn btn-secondary">Save Changes</button>
                                    </form>
                                </div>
                            </div>
                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Change Password</h5>
                                </div>
                                <div class="card-body">
                                    <form id="changePasswordForm">
                                        <div class="mb-3">
                                            <label for="currentPassword" class="form-label">Current Password</label>
                                            <input type="password" class="form-control" id="currentPassword" name="currentPassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="newPassword" class="form-label">New Password</label>
                                            <input type="password" class="form-control" id="newPassword" name="newPassword" required>
                                        </div>
                                        <div class="mb-3">
                                            <label for="confirmPassword" class="form-label">Confirm New Password</label>
                                            <input type="password" class="form-control" id="confirmPassword" name="confirmPassword" required>
                                        </div>
                                        <button type="submit" class="btn btn-secondary">Change Password</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </main>

            @include('component.footer')
        </div>
    </div>

    <script>
        $(document).ready(function () {
            $('.sidebar-item').removeClass('active');
        });
    </script>
    {{-- <script src="{{ asset('assets/js/userDashboard.js') }}"></script> --}}
    <script src="{{ asset('assets/js/app.js') }}"></script>
</body>

</html>
