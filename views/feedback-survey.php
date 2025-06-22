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

  <main>
    <div class="logreg-container">
      <?php
      require("partials/feedback-form.php");
      ?>
    </div>
  </main>

  <?php require("partials/footer.php"); ?>

</body>

</html>