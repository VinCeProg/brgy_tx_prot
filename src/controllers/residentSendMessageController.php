<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/TicketLog.php';



if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $ticket_id = intval($_POST["ticket_id"]);
  $resident_id = $_POST["resident_id"];
  $message = trim($_POST["message"]);

  if (!empty($ticket_id) && !empty($resident_id) && !empty($message)) {
    $residentMessage = new ResidentMessage($conn);
    $success = $residentMessage->addMessage($ticket_id, $resident_id, $message);

    if ($success) {
      echo "<script>alert(`Message Sent!`); window.location.href='/brgy_tx_prot/views/dashboard/tickets.php';</script>";
      exit();
    } else {
      echo "Error sending message.";
    }
  } else {
    echo "Please fill in all fields.";
  }
}
?>