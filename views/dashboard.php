<?php
$pagetitle = 'Dashboard';
session_start();
require("../functions.php");
require("partials/html.head.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// dd($_SERVER);

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: /brgy_tx_prot/views/login.php"); 
    exit(); // Stop execution after redirect
}
?>

<body>
  <?php require("partials/newnav.php") ?>
  <main>
    <?php require("partials/headline.php") ?>
    <?php require("partials/brgy-transparency.php") ?>
    <?php require("partials/mission-vision.php") ?>
  </main>
  <?php require("partials/footer.php") ?>
</body>

</html>