<?php
$pagetitle = 'Home';
  session_start();
  require("partials/html.head.php"); 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);
  // dd($_SERVER);
?>

<body>

  <?php require("partials/navbar.php") ?>

  <main>

    <?php require("partials/head-title.php") ?>
    <?php require("partials/head-ticket.php") ?>
    <?php require("partials/headline.php") ?>
    <?php require("partials/brgy-transparency.php") ?>
    <?php require("partials/ticket-table-resolved.php") ?>
    <?php require("partials/mission-vision.php") ?>

  </main>
  <?php require("partials/footer.php") ?>
</body>

</html>