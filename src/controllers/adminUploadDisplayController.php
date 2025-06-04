<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/DisplayTicket.php';

$displayTicketModel = new DisplayTicket($conn);

function cleanInput($value)
{
  return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ticketId = $_POST['ticket_id'] ?? '';
  $subject = cleanInput($_POST['subject'] ?? '');
  $description = cleanInput($_POST['description'] ?? '');

  // Default image path
  $web_path = "/brgy_tx_prot/uploads/default.png";
  $upload_dir = BASE_PATH . '/uploads/disptx/';

  // Ensure directory exists
  if (!is_dir($upload_dir)) {
    mkdir($upload_dir, 0755, true);
  }

  // Handle file upload if present
  if (!empty($_FILES['file_path']['name'])) {
    $original_name = basename($_FILES['file_path']['name']);
    $filename = time() . '-' . preg_replace('/\s+/', '_', $original_name); // Unique and clean
    $server_path = $upload_dir . $filename;
    $web_path = "/brgy_tx_prot/uploads/disptx/" . $filename;

    if (!move_uploaded_file($_FILES['file_path']['tmp_name'], $server_path)) {
      error_log("File upload failed. TMP: " . $_FILES['file_path']['tmp_name'] . " TO: " . $server_path);
      $errors[] = "Failed to upload file.";
    }
  }

  if (empty($errors)) {
    $success = $displayTicketModel->uploadDisplayTicket($ticketId, $subject, $description, $web_path);
    if ($success) {
      echo "<script>alert('Display created successfully.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=add-resolvedtx-display';</script>";
      exit;
    } else {
      $errors[] = "Database insert failed.";
    }
  }
}
