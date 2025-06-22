<?php
  $pagetitle = 'Feedback Form';
  session_start();
  require("../functions.php");
  require("partials/html.head.php"); 
?>

<body>

  <?php require("partials/navbar.php"); ?>

  <main>
    <?php
    require("partials/feedback-form.php");
    ?>
  </main>

  <?php require("partials/footer.php"); ?>
  
</body>
</html>
