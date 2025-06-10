<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/DisplayTicket.php';

$displayModel = new DisplayTicket($conn);

function cleanInput($value)
{
  return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $display_id = $_POST['display_id'] ?? '';
  $subject = cleanInput($_POST['subject']);
  $description = cleanInput($_POST['description']);
  $is_visible = isset($_POST['is_visible']) ? 1 : 0;

  $web_path = null; // keep null if no new file is uploaded

  // Upload directory
  $upload_dir = BASE_PATH . '/uploads/disptx/';

  // Ensure directory exists
  if (!is_dir($upload_dir)) {
    if (!mkdir($upload_dir, 0755, true)) {
      $errors[] = "Upload directory could not be created.";
    }
  }

  // Handle file upload if present
  if (!empty($_FILES['file_path']['name'])) {
    $original_name = basename($_FILES['file_path']['name']);
    $filename = time() . '-' . preg_replace('/\s+/', '_', $original_name); // Clean + timestamp
    $server_path = $upload_dir . $filename;
    $web_path = "/brgy_tx_prot/uploads/disptx/" . $filename;

    if (!move_uploaded_file($_FILES['file_path']['tmp_name'], $server_path)) {
      error_log("File upload failed. TMP: " . $_FILES['file_path']['tmp_name'] . " TO: " . $server_path);
      $errors[] = "Failed to upload file.";
    }
  }

  if (empty($errors)) {
    $updateData = [
      'subject' => $subject,
      'description' => $description,
      'is_visible' => $is_visible,
    ];

    // Include file_path only if new file uploaded
    if ($web_path) {
      $updateData['file_path'] = $web_path;
    }

    $success = $displayModel->updateDisplayTicket($display_id, $updateData);

    if ($success) {
      echo "<script>alert('Display updated successfully.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=manage-resolvedtx-display';</script>";
      exit();
    } else {
      $errors[] = "Failed to update display ticket.";
    }
  }
}
