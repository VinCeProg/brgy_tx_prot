<?php
$pagetitle = 'Feedback Form';
session_start();
require("../functions.php");
require("partials/html.head.php");
// print_r($_SESSION);
// exit();
?>

<body>

  <?php
  $navbar = (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in']) ? "partials/newnav.php" : "partials/navbar.php";
  require($navbar);
  ?>

  <main style="background-color: white; padding: 24px">
    <?php require("partials/faq.php") ?>
  </main>
  <a href="/brgy_tx_prot/views/feedback-survey.php" class="floating-feedback-btn"></a>
  <?php require("partials/footer.php"); ?>
</body>

</html>