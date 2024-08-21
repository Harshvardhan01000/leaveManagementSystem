<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <style>
        /* Ensure the logo is aligned with the other navbar items */
        .navbar-brand {
            display: flex;
            align-items: center;
            margin-right: 1rem;
            padding: 0.5rem 0;
            /* Adjust this padding as necessary */
        }

        /* Adjust the width of the dropdown menu */
        .dropdown-menu {
            min-width: 250px;
            /* Increase as needed */
        }

        /* Profile image styling */
        .nav-profile img {
            width: 40px;
            height: 40px;
            object-fit: cover;
        }

        /* Center align the text inside dropdown header */
        .dropdown-header h6,
        .dropdown-header small {
            margin-bottom: 0;
            text-align: center;
        }

        .chart-container {
            border: 2px solid #ddd;
            /* Light grey border */
            border-radius: 10px;
            /* Rounded corners */
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            /* Soft shadow */
            background-color: #fff;
            /* White background */
            padding: 20px;
            /* Space inside the container */
        }

        .chart-container canvas {
            max-width: 100%;
            /* Ensure charts fit within their container */
            height: auto;
            /* Maintain aspect ratio */
        }

        h5 {
            margin-bottom: 20px;
            /* Space between title and chart */
        }
        
    </style>
</head>

<body>
    @include('components.navbar')
    @include('components.adminDashbord')
    <div class="container text-center mt-4">
        <div class="btn btn-outline-success" data-bs-toggle="modal" data-bs-target="#holidayModal">create holiday</div>
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
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
