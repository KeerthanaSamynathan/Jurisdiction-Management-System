<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">ICJMS</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">
                <li class="nav-item">
                    <a class="nav-link" href="index.php">Home</a>
                </li>
                <?php if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true): ?>
                    <li class="nav-item">
                        <a class="nav-link" href="welcome.php">Dashboard</a>
                    </li>
                    <?php if ($_SESSION['role'] === 'student'): ?>
                        <li class="nav-item">
                            <a class="nav-link" href="view_profile.php">View Profile</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="upload_certificate.php">Upload Documents</a>
                        </li>
                        <li class="nav-item">
                    <a class="nav-link" href="view_certificates.php">View Documents</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="appointments.php">Book Appointments</a>
                        </li>
                    <?php endif; ?>
                    <li class="nav-item">
                        <a class="nav-link" href="logout.php">Logout</a>
                    </li>
                <?php else: ?>
                    <li class="nav-item">
                        <a class="nav-link" href="signupuser.php">User Login</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="signuplawyer.php">Lawyer Login</a>
                    </li>
                <?php endif; ?>
            </ul>
        </div>
    </div>
</nav>
