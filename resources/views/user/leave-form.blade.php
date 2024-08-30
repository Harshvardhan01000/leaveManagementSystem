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

</head>

<body>
    <div class="wrapper">

        @include('user.sidebar')

        <div class="main">

            @include('component.navbar')

            <main class="content">
                <div class="row">
                    <!-- Employee view page -->
                    <div class="col-xl-12 col-md-12 col-12">
                        <div class="card">
                            <div class="card-content">
                                <div class="card-body pb-0 mx-25">
                                    <!-- header section -->
                                    <div class="row mx-0">
                                        <div class="col-xl-4 col-md-12 d-flex align-items-center pl-0">
                                            <h4 class="mr-75">Add Leave</h4>
                                        </div>
                                    </div>
                                    <hr>
                                    <form class="form" method="POST" action="https://hrms.webcodegenie.com/leaves"
                                        enctype="multipart/form-data" id="create_leave">
                                        <input type="hidden" name="_token"
                                            value="FujhtrM8ylnUz6ZLxcjqKfhtQlNTdt8u4xSc1Lqu">
                                        <div class="card-content">
                                            <div class="card-body ">
                                                <div class="form-body">
                                                    <div class="row">

                                                        <div class="col-12 my-2">
                                                            <label for="leave_type">Leave Type</label><span
                                                                class="required">*</span>
                                                            <div class="form-group mt-2">
                                                                <div class="controls">
                                                                    <select name="leave_type" id="leave_type"
                                                                        class="js-example-placeholder-single js-states form-control"
                                                                        data-validation-required-message="Leave Type field is required">
                                                                        <option value="">Select leave</option>
                                                                        <option value="casual_leave">Casual Leave
                                                                        </option>
                                                                        <option value="medical_leave">Medical Leave
                                                                        </option>
                                                                        <option value="academic_leave">Academic Leave
                                                                        </option>
                                                                    </select>
                                                                    <div class="controls">
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4 my-2">
                                                            <label for="leave_date_range">Leave Date</label><span
                                                                class="required">*</span>
                                                            <div class="form-group  position-relative has-icon-left mt-2">

                                                                <input id="leave_date_range" class="form-control"
                                                                     placeholder="Select Date"
                                                                    readonly="" name="leave_date_range"
                                                                    type="date">

                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4 my-2">
                                                            <label for="start_period">Leave Start Period</label><span
                                                                id="lable_start_date"></span><span
                                                                class="required">*</span>
                                                            <div class="form-group mt-2">
                                                                <div class="controls">
                                                                    <select
                                                                        class="js-example-placeholder-single js-states form-control"
                                                                        id="start_period" name="leave_start_period">
                                                                        <option value="">Select Leave Start Period
                                                                        </option>
                                                                        <option value="full_day">
                                                                            Full Day</option>
                                                                        <option value="first_half">
                                                                            First Half</option>
                                                                        <option value="second_half">
                                                                            Second Half</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-12 col-sm-4" id="end_period_show"
                                                            style="display: none;">
                                                            <label for="end_period">Leave End Period</label><span
                                                                id="lable_end_date"></span><span
                                                                class="required">*</span>
                                                            <div class="form-group mt-2">
                                                                <div class="controls">
                                                                    <select
                                                                        class="js-example-placeholder-single js-states form-control"
                                                                        id="end_period" name="leave_end_period">
                                                                        <option value="">Select Leave End Period
                                                                        </option>
                                                                        <option value="full_day">
                                                                            Full Day</option>
                                                                        <option value="first_half">
                                                                            First Half</option>
                                                                    </select>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-12">
                                                        <label for="reason">Leave Reason</label><span
                                                            class="required">*</span>
                                                        <div class="form-group form-label-group mt-2">
                                                            <fieldset class="form-label-group">
                                                                <textarea id="reason" rows="4" class="form-control"
                                                                    data-validation-required-message="Leave reason field is required" placeholder="Add Leave Reason" name="reason"
                                                                    cols="50"></textarea>
                                                                <div class="controls">
                                                                </div>
                                                            </fieldset>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row" id="document" style="display:none">
                                                    <div class="col-12 col-sm-8 col-md-6 col-lg-4">
                                                        <label for="getFile">Document<span class="required"
                                                                id="doc-require-star"
                                                                style="display:none">*</span></label>
                                                        <label for="getFile"
                                                            class="btn btn-primary btn-block glow add-file-btn text-capitalize">
                                                            <i class="bx bx-plus"></i>Upload Documents</label>
                                                        <input type="file" name="upload_medical_documents"
                                                            id="getFile" class="d-none">
                                                        <div class="controls">
                                                            <div id="filenames">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-12 col-sm-4 col-md-6 col-lg-8 mt-1 mt-sm-0">
                                                        <div id="doc-warning" style="display: none">
                                                            <div class="alert border-warning alert-dismissible mb-2"
                                                                role="alert">
                                                                <div class="d-flex align-items-center">
                                                                    <i class="bx bx-error-circle"></i>
                                                                    <span>
                                                                        If you don't upload the document then your leave
                                                                        will be
                                                                        considered as casual. But can upload document
                                                                        afterwards till
                                                                        3 days
                                                                        after approved date or leave end date whichever
                                                                        is
                                                                        greater.
                                                                    </span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12 d-flex justify-content-end my-2">
                                            <button type="button" class="btn btn-primary mr-1 mb-1"
                                                id="check-for-validation">
                                                <span class="d-none d-sm-block">Submit</span>
                                            </button>
                                            <button type="submit" style="display: none" id="create-leave"
                                                class="btn btn-primary mr-1 mb-1 ladda-button"
                                                data-style="expand-left"><span class="ladda-label">Submit</span><span
                                                    class="ladda-spinner"></span></button>
                                            <button type="reset" class="btn btn-light-secondary mr-1 mb-1"
                                                onclick="window.location.href=window.location.href">Reset</button>
                                        </div>
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
    <script src="{{ asset('assets/js/app.js') }}"></script>
    <script src="{{ asset('assets/js/employeeView.js') }}"></script>

</body>

</html>
