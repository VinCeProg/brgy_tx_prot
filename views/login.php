<?php
  $pagetitle = 'Login/Signup';
  session_start();
  require("../functions.php");
  require("partials/html.head.php"); 
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
