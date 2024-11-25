<?php

include 'connect.php';

session_start();

if(isset($_SESSION['user_id'])){
   $user_id = $_SESSION['user_id'];
}else{
   $user_id = '';
};

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $email = $_POST['email'];
   $email = filter_var($email, FILTER_SANITIZE_STRING);
   $pass = sha1($_POST['pass']);
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);
   $cpass = sha1($_POST['cpass']);
   $cpass = filter_var($cpass, FILTER_SANITIZE_STRING);

   $select_user = $conn->prepare("SELECT * FROM `users` WHERE email = ?");
   $select_user->execute([$email,]);
   $row = $select_user->fetch(PDO::FETCH_ASSOC);

   if($select_user->rowCount() > 0){
      $message[] = 'email already exists!';
   }else{
      if($pass != $cpass){
         $message[] = 'confirm password not matched!';
      }else{
         $insert_user = $conn->prepare("INSERT INTO `users`(name, email, password) VALUES(?,?,?)");
         $insert_user->execute([$name, $email, $cpass]);
         $message[] = 'registered successfully, login now please!';
      }
   }

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>register</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link rel="stylesheet" href="./assets/css/styles.css">
   <link rel="stylesheet" href="./assets/css/log_reg.css">

</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="./index.html">
                <img src="./assets/images/download.png" alt="Logo" height="40" >
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="./features.html">Features</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#">Explore</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./template.html">Templates</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="aboutus.html">About us</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contactUs.html">Contact us</a>
                    </li>
                </ul>
            </div>
            <div class="d-flex align-items-center">
                <div class="dropdown">
                    <a href="#" class="d-block link-dark text-decoration-none" id="dropdownUser" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="./assets/images/usericon.png" alt="User" width="32" height="32" class="rounded-circle">
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="dropdownUser">
                        <li><a class="dropdown-item" href="user_login.php">Login</a></li>
                        <li><a class="dropdown-item" href="user_register.php">Register</a></li>
                    </ul>
                </div>
                <a class="btn btn-primary ms-3" href="./dashboard.html">Dashboard</a>
            </div>
        </div>
    </nav>
    
<section class="form-container">

   <form action="" method="post">
      <h3>register now</h3>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box">
      <input type="email" name="email" required placeholder="enter your email" maxlength="50"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="cpass" required placeholder="confirm your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="register now" class="btn" name="submit">
      <p>already have an account?</p>
      <a href="user_login.php" class="option-btn">login now</a>
   </form>

</section>

<script src="script.js"></script>
<footer class="footer bg-dark text-white py-4">
        <div class="container">
            <div class="row">
                <div class="col-md-2 mb-3">
                    <h5>Company</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Home</a></li>
                        <li><a href="#" class="text-white-50">About Us</a></li>
                        <li><a href="#" class="text-white-50">Learning Center</a></li>
                        <li><a href="#" class="text-white-50">Office Tools</a></li>
                        <li><a href="#" class="text-white-50">Mango AI</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h5>Cooperation</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Elite Program</a></li>
                        <li><a href="#" class="text-white-50">Partnership</a></li>
                        <li><a href="#" class="text-white-50">Community</a></li>
                        <li><a href="#" class="text-white-50">DMCA Policy</a></li>
                        <li><a href="#" class="text-white-50">Country Distributor</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h5>Support</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Contact Us</a></li>
                        <li><a href="#" class="text-white-50">Help Center</a></li>
                        <li><a href="#" class="text-white-50">Updates</a></li>
                        <li><a href="#" class="text-white-50">Gift Card Exchange</a></li>
                        <li><a href="#" class="text-white-50">Blog Archive</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h5>Follow Us</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Twitter</a></li>
                        <li><a href="#" class="text-white-50">Facebook</a></li>
                    </ul>
                </div>
                <div class="col-md-2 mb-3">
                    <h5>Policies</h5>
                    <ul class="list-unstyled">
                        <li><a href="#" class="text-white-50">Privacy</a></li>
                        <li><a href="#" class="text-white-50">Cookie Policy</a></li>
                        <li><a href="#" class="text-white-50">Terms of Service</a></li>
                    </ul>
                </div>
            </div>
            <p class="text-center mt-4 text-white-50">Explore Our Other Products: AI Video Generator, Animation Software, Video Maker, and more.</p>
            <p class="text-center text-white-50">&copy; 2024 WONDER IDEA TECHNOLOGY LIMITED. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>

</body>
</html>