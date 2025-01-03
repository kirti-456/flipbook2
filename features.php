<?php
session_start();
$is_logged_in = isset($_SESSION["user"]);
$user_name = "User"; // Placeholder for the user's name
$email = null;

if ($is_logged_in) {
    require_once "database.php"; // Include your database connection file
    if (isset($_SESSION['email'])) {
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    
    $sql = "SELECT full_name FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        $user_name = htmlspecialchars($user['full_name']); // Sanitize output
    }
}
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipbook Features</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/features.css">
</head>
<body>

    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ">
        <div class="container">
            <a class="navbar-brand" href="./index.php">
                <img src="./assets/images/download.png" alt="Logo" height="40" >
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="features.php">Features</a>
                    </li>
                    <!-- <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li> -->
                    <li class="nav-item">
                        <a class="nav-link" href="template.php">Templates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.php">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactUs.php">Contact us</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <a class="btn btn-primary me-3" href="./dashboard.php">Dashboard</a>
                <?php if ($is_logged_in): ?>
                    <!-- Profile Dropdown -->
                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none dropdown-toggle" id="dropdownProfile" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./assets/images/usericon.png" alt="User" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownProfile">
                            <li><h6 class="dropdown-header">Hi, <?php echo $user_name; ?>!</h6></li>
                            <li><a class="dropdown-item" href="update_user.php">Update Profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li>
                                <form action="logout.php" method="POST" class="d-inline">
                                    <button type="submit" class="dropdown-item text-danger">Logout</button>
                                </form>
                            </li>
                        </ul>
                    </div>
                <?php else: ?>
                    <!-- Login/Register Links -->
                    <div class="dropdown">
                        <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                            <img src="./assets/images/usericon.png" alt="User" width="32" height="32" class="rounded-circle">
                        </a>
                        <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                            <li><a class="dropdown-item" href="login.php">Login</a></li>
                            <li><a class="dropdown-item" href="registration.php">Register</a></li>
                        </ul>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </nav>

    <!-- Header Section -->
    <header class="header bg-primary text-white py-5">
        <div class="container d-flex align-items-center justify-content-between flex-wrap">
            <div>
                <h1 class="display-4 fw-bold">A Strong Flipbook Maker</h1>
                <p class="lead">Satisfying All Your Needs</p>
                <a href="#" class="btn btn-lg btn-light text-primary fw-bold">Try for Free</a>
            </div>
            <div class="flipbook-demo">
                <img src="./assets/images/demo.webp" alt="Flipbook Demo" class="img-fluid rounded shadow-lg">
            </div>
        </div>
    </header>

    <!-- Features Section -->
    <section class="features py-5 bg-light">
        <div class="container">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="feature-item p-4 bg-white rounded shadow-sm h-100 d-flex align-items-center">
                        <img src="./assets/images/convert.webp" alt="Convert Icon" class="me-4 feature-image img-fluid">
                        <div>
                            <h3>Convert</h3>
                            <p>Upload with multiple formats & sources or upload in batch. You can convert documents seamlessly, with support for various file types like PDFs, images, and even videos for enhanced multimedia experiences.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="feature-item p-4 bg-white rounded shadow-sm h-100 d-flex align-items-center">
                        <img src="./assets/images/template.webp" alt="Templates Icon" class="me-4 feature-image img-fluid">
                        <div>
                            <h3>Templates</h3>
                            <p>Quickly start with 100+ beautiful and continuously updated templates. Customize every aspect of your flipbook, including background, layout, fonts, and more.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="feature-item p-4 bg-white rounded shadow-sm h-100 d-flex align-items-center">
                        <img src="./assets/images/interact.webp" alt="Interactivity Icon" class="me-4 feature-image img-fluid">
                        <div>
                            <h3>Interactivity</h3>
                            <p>Add multimedia & interactive elements or animation. Enrich your flipbook with embedded videos, interactive forms, and clickable links to create an engaging reading experience.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row g-4">
                <div class="col-md-12">
                    <div class="share-item p-4 bg-white rounded shadow-sm h-100 d-flex align-items-center">
                        <img src="./assets/images/onlinesharing.webp" alt="Online Share" class="me-4 feature-image img-fluid">
                        <div>
                            <h3>Online Share</h3>
                            <p>Spread your content by link or connect to social media. Easily share your flipbook across multiple platforms with a simple link, or directly post it on your social media channels.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-12">
                    <div class="share-item p-4 bg-white rounded shadow-sm h-100 d-flex align-items-center">
                        <img src="./assets/images/offline.webp" alt="Offline Reading" class="me-4 feature-image img-fluid">
                        <div>
                            <h3>Offline Reading</h3>
                            <p>Share Your Flipbook As EXE Or APP. Download your flipbook to read offline on any device or distribute it as an executable file or standalone app.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js"></script>
    <footer>
    <div class="footer-container">
        <div class="footer-section">
            <h4>Company</h4>
            <ul>
                <li><a href="#">Home</a></li>
                <li><a href="#">About Us</a></li>
                <li><a href="#">Learning Center</a></li>
                <li><a href="#">Office Tools</a></li>
                <li><a href="#">Mango AI</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Cooperation</h4>
            <ul>
                <li><a href="#">Elite Program</a></li>
                <li><a href="#">Partnership</a></li>
                <li><a href="#">Community</a></li>
                <li><a href="#">DMCA Policy</a></li>
                <li><a href="#">Country Distributor</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Support</h4>
            <ul>
                <li><a href="#">Contact Us</a></li>
                <li><a href="#">Help Center</a></li>
                <li><a href="#">Updates</a></li>
                <li><a href="#">Gift Card Exchange</a></li>
                <li><a href="#">Blog Archive</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Follow Us</h4>
            <ul>
                <li><a href="#">Twitter</a></li>
                <li><a href="#">Facebook</a></li>
            </ul>
        </div>
        <div class="footer-section">
            <h4>Policies</h4>
            <ul>
                <li><a href="#">Privacy</a></li>
                <li><a href="#">Cookie Policy</a></li>
                <li><a href="#">Terms of Service</a></li>
            </ul>
        </div>
    </div>
    <div class="footer-bottom">
        <p>Explore Our Other Products: AI Video Generator, AI Video Maker, Animation Software, Whiteboard Animation Software, Character Animation Maker, Video Maker, Presentation Maker, Flipbook Software</p>
        <p>© 2024 WONDER IDEA TECHNOLOGY LIMITED. All rights reserved</p>
    </div>
</footer>

</body>
</html>
