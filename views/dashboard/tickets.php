<?php
$pagetitle = 'Issue Tracker';
session_start();
require_once("../../config/auth.php");
require("../../functions.php");
require("../partials/html.head.php");
error_reporting(E_ALL);
ini_set('display_errors', 1);
// dd($_SERVER);

if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
  header("Location: /brgy_tx_prot/views/login.php");
  exit(); // Stop execution after redirect
}
?>

<body>
  <?php require("../partials/newnav.php") ?>
  <main style="background-color: var(--background-color); padding: 20px;">
    <div class="title-container" id="transparency-service">
      <h3>MY REQUESTS</h3>
      <p>Here, you can view the status of your submitted tickets, track updates, and create new requests for assistance.</p>
      <a href="submission.php" class="btn-add-tx">OPEN NEW TICKET</a>
    </div>
    <br>
    <?php
    require("../../config/database.php");
    require("../../src/models/Ticket.php");
    $ticket = new Ticket($conn);
    $residentID = $_SESSION['resident']['UserID'];
    $tickets = $ticket->getTicketsByResidentID($residentID);
    ?>
    <div class="ticket-wrapper">
      <?php require("partials/ticket-card.php"); ?>
    </div>

  </main>
  <?php require("../partials/footer.php") ?>
</body>

</html>