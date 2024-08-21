<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <!-- Brand -->
        <a class="navbar-brand" href="#">
            <img src="assets/img/apple-touch-icon.png" alt="Brand Logo" style="height: 40px; width: 40px;">
           <b class="ms-1">Leave Management</b> 
        </a>

        <!-- Toggler/collapsibe Button -->
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <!-- Navbar links -->
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item mt-2">
                    <a class="nav-link active" href="#">Dashbord</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="employeeListing">Employee List</a>
                </li>
                <li class="nav-item mt-2">
                    <a class="nav-link" href="leaveApproval">Leave Approval</a>
                </li>

                <!-- User Profile Dropdown -->
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle d-flex align-items-center" href="#" id="userDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="https://via.placeholder.com/40" alt="User Image" class="rounded-circle me-2 nav-profile">
                        <span>Kevin Anderson</span>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="userDropdown">
                        <li class="dropdown-header">
                            <h6>Kevin Anderson</h6>
                            <small>Web Designer</small>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="#">My Profile</a>
                        </li>
                        <li>
                            <a class="dropdown-item" href="#">Account Settings</a>
                        </li>
                        <li><hr class="dropdown-divider"></li>
                        <li>
                            <a class="dropdown-item" href="login">Sign Out</a>
                        </li>
                    </ul>
                </li>
                <!-- End User Profile Dropdown -->
            </ul>
        </div>
    </div>
</nav>