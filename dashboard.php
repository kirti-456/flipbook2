<?php
session_start();
include('database.php');

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$is_logged_in = isset($_SESSION["user"]);
$user_name = "User"; 
$email = null;

if ($is_logged_in) {
    require_once "database.php"; 
    if (isset($_SESSION['email'])) {
        $email = mysqli_real_escape_string($conn, $_SESSION['email']);
    
    $sql = "SELECT full_name FROM users WHERE email = '$email'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    if ($user) {
        $user_name = htmlspecialchars($user['full_name']); 
    }
}
}

$userId = null;
$userId = $_SESSION['user_id'];
$stmt = $conn->prepare("SELECT flipbook_name, flipbook_path, created_at FROM flipbooks WHERE user_id = ?");
$stmt->bind_param("i", $userId);
$stmt->execute();
$result = $stmt->get_result();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Flipbook Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="./assets/css/dashboard.css">
</head>
<body>
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

    <main>
        <aside>
            <ul class="sidebar">
                <li><a href="#">Home</a></li>
                <li><a href="#">Library</a></li>
                <ul>
                    <li><a href="#">Publications</a></li>
                    <li><a href="#">Bookcases</a></li>
                    <li><a href="#">Book Chatbots</a></li>
                    <li><a href="#">My Templates</a></li>
                </ul>
                <li><a href="create.php">Create now</a></li>
                <li><a href="#">Branding</a></li>
                <li><a href="#">Statistics</a></li>
            </ul>
        </aside>

        <section class="main-content">
            <button id="myUploadsButton" class="btn btn-primary mb-3">My Uploads</button>
            <div id="flipbooksContainer" class="flipbooks-container">
            <!-- Flipbooks will be loaded here dynamically -->
            </div>
        </section>

        
    </main>

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

<script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.css">

<script>
    document.addEventListener("DOMContentLoaded", () => {
        const myUploadsButton = document.getElementById("myUploadsButton");
        const flipbooksContainer = document.getElementById("flipbooksContainer");

        let isTableVisible = false;

        myUploadsButton.addEventListener("click", () => {
            if (isTableVisible) {
                // Hide the table
                flipbooksContainer.innerHTML = "";
                isTableVisible = false;
            } else {
                // Show the table
                flipbooksContainer.innerHTML = "<p>Loading...</p>";
                fetch("fetch_flipbooks.php")
                    .then(response => response.json())
                    .then(data => {
                        flipbooksContainer.innerHTML = "";
                        if (data.length > 0) {
                            const table = document.createElement("table");
                            table.className = "table table-striped table-hover";

                            table.innerHTML = `
                                <thead class="table-dark">
                                    <tr>
                                        <th>Name</th>
                                        <th>Created On</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                </tbody>
                            `;

                            const tbody = table.querySelector("tbody");
                            data.forEach(flipbook => {
                                const row = document.createElement("tr");
                                row.innerHTML = `
                                    <td>${flipbook.name}</td>
                                    <td>${flipbook.created_at}</td>
                                    <td>
                                        <a href="${flipbook.path}" target="_blank" class="btn btn-success btn-sm me-1">View</a>
                                        <button class="btn btn-primary btn-sm me-1" onclick="saveFlipbook('${flipbook.id}')">Save</button>
                                        <button class="btn btn-danger btn-sm" onclick="deleteFlipbook('${flipbook.id}')">Delete</button>
                                    </td>
                                `;
                                tbody.appendChild(row);
                            });
                            flipbooksContainer.appendChild(table);
                        } else {
                            flipbooksContainer.innerHTML = "<p>No flipbooks uploaded yet.</p>";
                        }
                        isTableVisible = true;
                    })
                    .catch(error => {
                        console.error("Error fetching flipbooks:", error);
                        flipbooksContainer.innerHTML = "<p>Error loading flipbooks.</p>";
                    });
            }
        });
    });

    function saveFlipbook(id) {
        alert(`Save functionality for Flipbook ID: ${id} is under development.`);
    }

    function deleteFlipbook(id) {
        if (confirm("Are you sure you want to delete this flipbook?")) {
            fetch(`delete_flipbook.php?id=${id}`, { method: "POST" })
                .then(response => response.json())
                .then(data => {
                    if (data.success) {
                        alert("Flipbook deleted successfully!");
                        document.getElementById("myUploadsButton").click(); // Refresh table
                    } else {
                        alert(`Error deleting flipbook: ${data.error}`);
                    }
                })
                .catch(error => {
                    console.error("Error deleting flipbook:", error);
                });
        }
    }
</script>

</body>
</html>