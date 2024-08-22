    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Pie Chart</h5>

                    <!-- Pie Chart -->
                    <canvas id="pieChart" style="max-height: 400px;"></canvas>

                    <!-- End Pie CHart -->

                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">Doughnut Chart</h5>

                    <!-- Doughnut Chart -->
                    <canvas id="doughnutChart" style="max-height: 400px;"></canvas>

                    <!-- End Doughnut CHart -->

                </div>
            </div>
        </div>
    </div>
    <div class="container text-center mt-4">
        <div class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#holidayModal">create
            holiday</div>
    </div>

    {{-- holiday modal --}}
    <div class="modal fade" id="holidayModal" tabindex="-1" aria-labelledby="holidayModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="holidayModalLabel">Create Holiday</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="holidayForm">
                        <div class="mb-3">
                            <label for="holidayName" class="form-label">Holiday Name</label>
                            <input type="text" class="form-control" id="holidayName" required>
                        </div>
                        <div class="mb-3">
                            <label for="holidayDate" class="form-label">Holiday Date</label>
                            <input type="date" class="form-control" id="holidayDate" required>
                        </div>
                        <div class="mb-3">
                            <label for="holidayDescription" class="form-label">Description</label>
                            <textarea class="form-control" id="holidayDescription" rows="3"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary">Save Holiday</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="charts/presentEmployeeChart.js"></script>
