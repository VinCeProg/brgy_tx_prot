<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Ticket.php';
require BASE_PATH . '/src/models/TicketLog.php';

$ticket = new Ticket($conn);
$ticketLog = new TicketLog($conn); // ← don't forget to instantiate this!

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['update_ticket'])) {
  $ticket_id = $_POST['ticket_id'];
  $new_status = $_POST['status'];
  $new_priority = $_POST['priority_level'];

  $current = $ticket->getTicketByTicketID($ticket_id);
  if (!$current) {
    die("Ticket not found");
  }

  $old_status = $current['status'];
  $old_priority = $current['priority_level'];

  $ticket->updateTicket($ticket_id, $new_status, $new_priority);

  // Log change if there is any
  if ($old_status !== $new_status || $old_priority !== $new_priority) {
    $ticketLog->logChange($ticket_id, $old_status, $new_status, $old_priority, $new_priority);
  }

  header("Location: ../../views/helpdesk/view-ticket.php?id=$ticket_id");
  exit();
}
