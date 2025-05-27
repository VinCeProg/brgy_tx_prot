<?php
$current_uri = $_SERVER['REQUEST_URI']; 
$isDashboard = strpos($current_uri, "/brgy_tx_prot/views/dashboard/") !== false;

// Define correct home URL
$home_url = $isDashboard ? "/brgy_tx_prot/views/dashboard/index.php" : "/brgy_tx_prot/index.php";
?>

<header>
  <div class="title">
    <a href="<?php echo $home_url; ?>"><img src="/brgy_tx_prot/public/images/barangay.svg" alt="Barangay Logo" /></a>
  </div>
  
  <nav class="navbar">
    <ul>
      <li><a href="<?php echo $home_url; ?>">HOME</a></li>
      <li><a href="/brgy_tx_prot/views/dashboard/index.php#transparency-service">GALLERY</a></li>
      <li><a href="/brgy_tx_prot/views/dashboard/index.php#headline">CONTACTS</a></li>
      <li><a href="/brgy_tx_prot/views/dashboard/index.php#about-us">ABOUT</a></li>
    </ul>

    <div class="login-wrapper">
      <a href="/brgy_tx_prot/src/controllers/residentLogoutController.php" class="login-btn">LOG OUT</a>
    </div>
  </nav>

  <button class="menu-btn" onclick="toggleMenu()">☰</button>
</header>

<script src="/brgy_tx_prot/public/js/mobile-menu.js"></script>
