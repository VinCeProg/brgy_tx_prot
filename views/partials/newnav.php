<?php
$current_uri = $_SERVER['REQUEST_URI']; // Get current page URI
$isDashboard = strpos($current_uri, "/brgy_tx_prot/views/dashboard.php") !== false;
?>

<header>
  <div class="title">
    <a href="#"><img src="/brgy_tx_prot/public/images/barangay.svg" alt="Barangay Logo" /></a>
  </div>
  <nav class="navbar">
    <ul>
      <li>
        <a href="<?php echo $isDashboard ? '/brgy_tx_prot/views/dashboard' : '/brgy_tx_prot/index.php'; ?>">
          HOME
        </a>
      </li>
      <li><a href="#transparency-service">GALLERY</a></li>
      <li><a href="#">COMPLAINTS</a></li>
      <li><a href="#headline">CONTACTS</a></li>
      <li><a href="#about-us">ABOUT</a></li>
    </ul>
    <div class="login-wrapper">
      <a href="/brgy_tx_prot/src/controllers/residentLogoutController.php" class="login-btn">LOG OUT</a>
    </div>
  </nav>
  <button class="menu-btn" onclick="toggleMenu()">☰</button>
</header>

<script src="/brgy_tx_prot/public/js/mobile-menu.js"></script>
