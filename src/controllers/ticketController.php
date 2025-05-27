<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Ticket.php';

function cleanInput($value)
{
  return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

$ticket = new Ticket($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  

  $web_path = "/brgy_tx_prot/uploads/default.png"; // Default image path
  $upload_dir = __DIR__ . '/../../uploads/';       // Physical folder path

  // Ensure upload directory exists
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
  }

  // Handle file upload
  if (!empty($_FILES['file']['name'])) {
    $file_name = basename($_FILES['file']['name']);
    $server_path = $upload_dir . $file_name;
    $web_path = "/brgy_tx_prot/uploads/" . $file_name;

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $server_path)) {
      error_log("File upload failed. TMP: " . $_FILES['file']['tmp_name'] . " TO: " . $server_path);
      header("Location: ticket_form.php?error=upload_failed");
      exit();
    }
  }

  // Prepare ticket data
  $data = [
    "issue_type" => $_POST['issue-type'],
    "subject" => cleanInput($_POST['subject']),
    "description" => cleanInput($_POST['description']),
    "file_path" => $web_path,
    "requested_by" => $_SESSION['resident']['UserID'],
    "issue_address" => cleanInput($_POST['issue_address'])
  ];

  // Create ticket
  if (!$ticket->createTicket($data)) {
    header("Location: ticket_form.php?error=submission_failed");
    exit();
  }

  header("Location: /brgy_tx_prot/views/dashboard/tickets.php");
  exit();
}
?>
