@extends('welcome')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center mb-4">
                        <h5 class="card-title">Pie Chart</h5>

                        <!-- Filter Dropdown -->
                        <div class="dropdown m-3">
                            <button class="btn btn-outline-secondary border dropdown-toggle" type="button"
                                id="dateRangeFilter" data-bs-toggle="dropdown" aria-expanded="false">
                                Last 7 Days
                            </button>
                            <ul class="dropdown-menu" aria-labelledby="dateRangeFilter">
                                <li><a class="dropdown-item" href="#" data-value="last7days">Last 7 Days</a></li>
                                <li><a class="dropdown-item" href="#" data-value="currentweek">Current Week</a></li>
                                <li><a class="dropdown-item" href="#" data-value="lastweek">Last Week</a></li>
                                <li><a class="dropdown-item" href="#" data-value="currentmonth">Current Month</a></li>
                                <li><a class="dropdown-item" href="#" data-value="lastmonth">Last Month</a></li>
                            </ul>
                        </div>
                    </div>



                    <!-- Pie Chart -->
                    <canvas id="pieChart" style="max-height: 400px;"></canvas>

                    <!-- End Pie CHart -->

                </div>
            </div>
        </div>
    </div>

    <script src="assets/js/viewPage.js"></script>
@endsection
