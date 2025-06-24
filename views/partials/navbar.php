<?php
$current_uri = $_SERVER['REQUEST_URI']; 
$isDashboard = strpos($current_uri, "/brgy_tx_prot/views/dashboard/") !== false;

// Define correct home URL
$home_url = $isDashboard ? "/brgy_tx_prot/views/dashboard/index.php" : "/brgy_tx_prot/index.php";
?>
<header>
  <div class="title">
    <a href="#"><img src="/brgy_tx_prot/public/images/barangay.svg" alt="Baranggay Logo" /></a>
  </div>
  <nav class="navbar">
    <ul>
      <li><a href="<?= $home_url ?>">HOME</a></li>
      <li><a href="<?= $home_url ?>#transparency-service">GALLERY</a></li>
      <li><a href="<?= $home_url ?>#headline">CONTACTS</a></li>
      <li><a href="<?= $home_url ?>#about-us">ABOUT</a></li>
      <li><a href="frequently-asked-questions.php">FAQ</a></li>
    </ul>
    <div class="login-wrapper" title="Login">
      <a href="/brgy_tx_prot/views/login.php" class="login-btn">LOG IN</a>
    </div>
  </nav>
  <button class="menu-btn" onclick="toggleMenu()">☰</button>
</header>
<script src="/brgy_tx_prot/public/js/mobile-menu.js"></script>