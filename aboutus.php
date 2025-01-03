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
    <link rel="stylesheet" href="./assets/css/aboutus.css">
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
                        <a class="nav-link" href="./template.php">Templates</a>
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

    <div class="aboutus">
        <h1>About Us</h1>
        <p>Welcome to <strong>FLIPBOOK</strong>, the ultimate platform for bringing your stories, memories, and ideas to life through interactive flipbooks. We are passionate about transforming your files, images, PDFs, and texts into visually engaging digital flipbooks, designed to captivate and inspire.</p>
        
        <p>Our mission is simple: to empower creators, professionals, and hobbyists alike with an easy-to-use, powerful tool for creating beautiful, dynamic flipbooks. Whether you’re crafting a digital portfolio, an interactive report, a photo album, or any other kind of presentation, our platform lets you turn static content into something truly memorable.</p>
        
        <p>With innovative technology and seamless page-turning functionality powered by Turn.js and pdf.js, our flipbooks deliver a realistic reading experience that enhances user engagement. Security is also our priority; all flipbooks are saved securely in your account for quick and easy access anytime, anywhere.</p>

        <p>At <strong>FLIPBOOK</strong>, we believe that everyone has a story worth sharing. Join us in bringing yours to life!</p>

        <h2 class="section-title">Why Choose Us?</h2>
        <ul>
            <li><strong>User-Friendly Platform</strong>: No technical skills required. Our intuitive interface makes flipbook creation accessible to everyone.</li>
            <li><strong>Versatile Features</strong>: Upload files, images, PDFs, and text to create flipbooks that suit your unique needs.</li>
            <li><strong>High Quality & Performance</strong>: Our flipbooks load quickly, are responsive across devices, and offer a smooth, realistic reading experience.</li>
            <li><strong>Secure & Personalized</strong>: Log in to your account to save and manage your flipbooks securely.</li>
        </ul>

        <p>We’re here to help you transform ordinary content into extraordinary experiences. Get started with <strong>FLIPBOOK</strong> today and see how easy it is to create your own digital flipbooks!</p>
    </div>
    
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