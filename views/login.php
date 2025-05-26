<?php
  $pagetitle = 'Login/Signup';
  session_start();
  require("../functions.php");
  require("partials/html.head.php"); 
  error_reporting(E_ALL);
  ini_set('display_errors', 1);

  if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] === true) {
      header("Location: dashboard.php");
      exit();
  }
?>

<body>

  <?php require("partials/navbar.php"); ?>

  <main>
    <?php
    require("partials/login-register.php");
    ?>
  </main>

  <?php require("partials/footer.php"); ?>
  
</body>
</html>
