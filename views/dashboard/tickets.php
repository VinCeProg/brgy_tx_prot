<?php
$pagetitle = 'Tickets';
session_start();
require_once("../../config/auth.php");
require("../../functions.php");
require("../partials/html.head.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// dd($_SERVER);

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: /brgy_tx_prot/views/login.php"); 
    exit(); // Stop execution after redirect
}
?>

<body>
  <?php require("../partials/newnav.php") ?>
  <main style="color: white; padding: 40px;">
    
    <?php 
      echo "Ticket goes here <br>";
      echo  __DIR__ ."<br>";
      echo "<pre>". print_r($_SESSION) . "</pre>";
    ?>

  </main>
  <?php require("../partials/footer.php") ?>
</body>

</html>