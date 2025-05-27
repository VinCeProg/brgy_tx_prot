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
  // Default file path
  $filePath = "/brgy_tx_prot/uploads/default.png";

  // Handle file upload
  if (!empty($_FILES['file']['name'])) {
    $upload_dir = "/brgy_tx_prot/uploads/";
    $file_name = basename($_FILES['file']['name']);
    $filePath = $upload_dir . $file_name;

    if (!move_uploaded_file($_FILES['file']['tmp_name'], $filePath)) {
      header("Location: ticket_form.php?error=upload_failed");
      exit();
    }
  }

  // Prepare data
  $data = [
    "issue_type" => $_POST['issue-type'],
    "subject" => cleanInput($_POST['subject']),
    "description" => cleanInput($_POST['description']),
    "file_path" => $filePath,
    "requested_by" => $_SESSION['resident']['UserID']
  ];

  // Submit ticket
  if (!$ticket->createTicket($data)) {
    header("Location: ticket_form.php?error=submission_failed");
    exit();
  }

  header("Location: success_page.php");
  exit();
}
?>
