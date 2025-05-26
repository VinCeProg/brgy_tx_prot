<?php
session_start();
require("../functions.php");
require("partials/html.head.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// dd($_SERVER);
?>

<body>
  <?php require("partials/newnav.php") ?>
  <main style="color: white;">
    <?php require("partials/headline.php") ?>
    <?php require("partials/brgy-transparency.php") ?>
    <?php require("partials/mission-vision.php") ?>
  </main>
  <?php require("partials/footer.php") ?>
</body>

</html>