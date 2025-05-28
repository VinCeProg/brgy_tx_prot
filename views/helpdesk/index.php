<?php
$pagetitle = 'Home';
// require("../../config/staff-auth.php"); //for login auth
require("../../functions.php");
require("partials/html.head.php");
// dd($_SERVER);
?>

<body>

  <?php require("partials/navbar.php"); ?>

  <main>
    <?php
    require("partials/dashboard.php");

    require("partials/ticket-table.php");
    ?>
  </main>

</body>

</html>