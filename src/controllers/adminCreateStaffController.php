<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Staff.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $resident_id = isset($_POST["resident_id"]) ? intval($_POST["resident_id"]) : null;
  $password = isset($_POST["password"]) ? trim($_POST["password"]) : '';
  $confirm_password = isset($_POST["confirm_password"]) ? trim($_POST["confirm_password"]) : '';

  // Validate input
  if (!$resident_id || empty($password) || empty($confirm_password)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: /brgy_tx_prot/views/helpdesk/create-staff-account.php");
    exit();
  }

  // Initialize Staff model
  $staffModel = new Staff($conn);
  $success = $staffModel->createStaffAccount($resident_id, $password);

  if ($success) {
    echo "<script>alert('Staff account created successfully.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=manage-staff-accounts';</script>";
  } else {
    echo "<script>alert('Failed to create staff account.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php';</script>";
  }
  exit();
}
