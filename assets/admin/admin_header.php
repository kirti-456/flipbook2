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
<header class="header">

<section class="flex">

<a class="navbar-brand" href="dashboard.php">
                <img src="../../assets/images/download.png" alt="Logo" height="40" >
            </a>

   <nav class="navbar">
      <a href="../../assets/admin/users_accounts.php">Users</a>
      <a href="../../template.php">Templates</a>
      <!-- <a href="../../aboutus.php">About us</a> -->
      <a href="messagess.php">Messages</a>
   </nav>

   <div class="icons">
      <div id="menu-btn" class="fas fa-bars"></div>
      <div id="user-btn" class="fas fa-user"></div>
   </div>

   <div class="profile">
      <?php
         $select_profile = $conn->prepare("SELECT * FROM `admins` WHERE id = ?");
         $select_profile->execute([$admin_id]);
         $fetch_profile = $select_profile->fetch(PDO::FETCH_ASSOC);
      ?>
      <p><?= $fetch_profile['name']; ?></p>
      <a href="../admin/update_profile.php" class="btn">update profile</a>
      <div class="flex-btn">
         <a href="register_admin.php" class="option-btn">register</a>
         <a href="admin_login.php" class="option-btn">login</a>
      </div>
      <a href="admin_logout.php" class="delete-btn" onclick="return confirm('logout from the website?');">logout</a> 
   </div>

</section>

</header>
