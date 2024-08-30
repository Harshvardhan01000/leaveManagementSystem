<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="Responsive Admin &amp; Dashboard Template based on Bootstrap 5">
    <meta name="author" content="AdminKit">
    <meta name="keywords"
        content="adminkit, bootstrap, bootstrap 5, admin, dashboard, template, responsive, css, sass, html, theme, front-end, ui kit, web">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.gstatic.com">
    <link rel="shortcut icon" href="{{ asset('assets/icons/icon-48x48.png') }}" />

    <link rel="canonical" href="https://demo-basic.adminkit.io/" />

    <title>Leave Management System</title>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.5/font/bootstrap-icons.min.css">
    <link href="{{ asset('assets/css/app.css') }}" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4="
        crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/apexcharts"></script>

</head>

<body>
    <div class="wrapper">

        @include('component.sidebar')

        <div class="main">

            @include('component.navbar')

            <main class="content">
                <div class="container-fluid p-0">

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <h1 class="h3 d-inline align-middle">Profile</h1>
                        {{-- @if (Auth()->user()->role) --}}
                            <button class="btn btn-outline-secondary" data-bs-toggle="modal"
                                data-bs-target="#saralyEdit">
                                Edit Salary
                            </button>
                        {{-- @endif --}}

                    </div>
                    <div class="row">
                        <div class="col-md-4 col-xl-3">
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
                        <div class="col-md-8 col-xl-9">
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">Attedance Chart</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <canvas id="chartjs-dashboard-line"></canvas>
                                    </div>
                                </div>
                            </div>
                            <div class="card flex-fill w-100">
                                <div class="card-header">

                                    <h5 class="card-title mb-0">salary Chart</h5>
                                </div>
                                <div class="card-body py-3">
                                    <div class="chart chart-sm">
                                        <div id="reportsChart"></div>
                                    </div>
                                </div>
                            </div>


                            <div class="card mb-3">
                                <div class="card-header">
                                    <h5 class="card-title mb-0">Leave Details</h5>
                                </div>
                                <div class="card-body">
                                    <table class="table table-hover my-0 text-center">
                                        <thead>
                                            <tr>
                                                <th>Leave Type</th>
                                                <th class="d-none d-md-table-cell">Status</th>
                                                <th class="d-none d-xl-table-cell">Start Date</th>
                                                <th class="d-none d-xl-table-cell">End Date</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                                <td><span class="badge bg-success">Casual Leave</span></td>
                                                <td><span class="text-info">pending</span></td>
                                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-success">Casual Leave</span></td>
                                                <td><span class="text-info">pending</span></td>
                                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                            </tr>
                                            <tr>
                                                <td><span class="badge bg-success">Casual Leave</span></td>
                                                <td><span class="text-info">pending</span></td>
                                                <td class="d-none d-xl-table-cell">01/01/2023</td>
                                                <td class="d-none d-xl-table-cell">31/06/2023</td>
                                            </tr>



                                        </tbody>
                                    </table>
                                </div>
                            </div>



                        </div>
                    </div>

                </div>
            </main>

            @include('component.footer')
        </div>
    </div>

    {{-- holiday modal --}}
    <div class="modal fade" id="saralyEdit" tabindex="-1" aria-labelledby="saralyEditLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="saralyEditLabel">Salary Form</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="holidayForm">
                        <div class="mb-3">
                            <label for="basicSalary" class="form-label">Basic Salary</label>
                            <input type="number" class="form-control" id="basicSalary" name="basicSalary"
                                value="30000" required>
                        </div>
                        <div class="mb-3">
                            <label for="allowances" class="form-label">Allowances</label>
                            <input type="number" class="form-control" id="allowances" name="allowances"
                                value="5000" required>
                        </div>
                        <div class="mb-3 text-danger">
                            <label for="deduction" class="form-label">Deduction</label>
                            <input type="number" class="form-control text-danger" id="deduction" name="deduction"
                                value="2000" required>
                        </div>
                        <div class="mb-3">
                            <label for="paymentDate" class="form-label">Payment Date</label>
                            <input type="date" class="form-control" id="paymentDate" name="paymentDate"
                                value="2024-08-29" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Edit Salary</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/js/employeeView.js') }}"></script>
    <script src="{{ asset('assets/js/app.js') }}"></script>

</body>

</html>
