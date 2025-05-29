<?php
$pagetitle = 'View Ticket';
// require("../../config/staff-auth.php"); //for login auth
require("../../functions.php");
require("partials/html.head.php");
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../src/models/Ticket.php";
$ticketModel = new Ticket($conn);
$ticket = $ticketModel->getTicketByTicketID($_GET['id']);
// dd($_SERVER);
?>

<body>

  <?php require("partials/navbar.php"); ?>

  <main>
    <?php require("partials/section.summary.php"); ?>
  </main>
<script src="/brgy_tx_prot/public/js/status-colorcode.js"></script>
</body>

</html>