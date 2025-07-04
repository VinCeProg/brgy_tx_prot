<?php
$pagetitle = 'Overview';
require("../../config/staff-auth.php"); //for login auth
require("../../functions.php");
require("partials/html.head.php");
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../src/models/Ticket.php";
$ticketModel = new Ticket($conn);
$tickets = $ticketModel->getAllTicketsWithFullName();
// dd($_SESSION);
?>

<body>

  <?php require("partials/navbar.php"); ?>

  <main>
    <?php
    require("partials/dashboard.php");

    require("partials/ticket-table.php");
    ?>
  </main>
  <script src="/brgy_tx_prot/public/js/status-colorcode.js"></script>
  <script src="/brgy_tx_prot/public/js/searchtable.js"></script>
  <script src="/brgy_tx_prot/public/js/sorttable.js"></script>
</body>

</html>