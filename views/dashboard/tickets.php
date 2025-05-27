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
  <main style="color: white; padding: 40px;">

    <?php
    require("../../config/database.php");
    require("../../src/models/Ticket.php");
    $ticket = new Ticket($conn);
    $residentID = $_SESSION['resident']['UserID'];
    $tickets = $ticket->getTicketsByResidentID($residentID);

    foreach($tickets as $ticket) {
      echo "<br> <img src=\"{$ticket['file_path']}\" width=\"100px\">";
      echo "<br> <h1>{$ticket['subject']} </h1>";
      echo "<br> <h2>{$ticket['issue_type']} </h2>";
      echo "<br> <p>{$ticket['description']} </p>";
      echo "<br> <p>{$ticket['created_at']} </p> <br> <br>";
    }
    ?>

  </main>
  <?php require("../partials/footer.php") ?>
</body>

</html>