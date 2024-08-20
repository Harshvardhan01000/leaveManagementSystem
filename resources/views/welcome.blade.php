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
    </style>
</head>

<body>
    @include('components.navbar')
    @include('components.AdminDashbord')
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
    </script>
</body>

</html>
