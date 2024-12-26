<?php

include 'connect.php';

session_start();

if(isset($_POST['submit'])){

   $name = $_POST['name'];
   $name = filter_var($name, FILTER_SANITIZE_STRING);
   $pass = $_POST['pass'];
   $pass = filter_var($pass, FILTER_SANITIZE_STRING);

   $select_admin = $conn->prepare("SELECT * FROM `admins` WHERE name = ? AND password = ?");
   $select_admin->execute([$name, $pass]);
   $row = $select_admin->fetch(PDO::FETCH_ASSOC);

   if($select_admin->rowCount() > 0){
      $_SESSION['admin_id'] = $row['id'];
      header('location:dashboard.php');
   }else{
      $message[] = 'incorrect username or password!';
   }

}
?>

<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>login</title>

   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet">
   <link rel="stylesheet" href="../../assets/css/admin_style.css">
   <link rel="stylesheet" href="../../assets/css/styleadmin.css">
</head>
<body>
   <nav class="navbar navbar-expand-lg navbar-light bg-light shadow-sm ">
      <div class="container">
      <a class="navbar-brand" href="../../index.php">
         <img src="../../assets/images/download.png" alt="Logo" height="40" >
      </a>
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
         <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse justify-content-center" id="navbarNav">
         <ul class="navbar-nav">
               <li class="nav-item">
                  <a class="nav-link" href="../../features.php">Features</a>
               </li>
               <!-- <li class="nav-item">
                  <a class="nav-link" href="#">Explore</a>
               </li> -->
               <li class="nav-item">
                  <a class="nav-link" href="../../template.php">Templates</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="../../aboutus.php">About us</a>
               </li>
               <li class="nav-item">
                  <a class="nav-link" href="../../contactUs.php">Contact us</a>
               </li>
         </ul>
      </div>
   </nav>
<?php
   if(isset($message)){
      foreach($message as $message){
         echo '
         <div class="message">
            <span>'.$message.'</span>
            <i class="fas fa-times" onclick="this.parentElement.remove();"></i>
         </div>
         ';
      }
   }
?>

<section class="form-container">

   <form action="" method="post">
      <h3>admin login</h3>
      <input type="text" name="name" required placeholder="enter your username" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="password" name="pass" required placeholder="enter your password" maxlength="20"  class="box" oninput="this.value = this.value.replace(/\s/g, '')">
      <input type="submit" value="login now" class="btn" name="submit">
   </form>

</section>
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

</body>
</html>