<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Staff.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $staff_id = isset($_POST["staff_id"]) ? intval($_POST["staff_id"]) : null;
  $password = isset($_POST["password"]) && !empty(trim($_POST["password"])) ? trim($_POST["password"]) : null;
  $confirm_password = isset($_POST["confirm_password"]) && !empty(trim($_POST["confirm_password"])) ? trim($_POST["confirm_password"]) : null;
  $is_active = isset($_POST["is_active"]) && $_POST["is_active"] === "1" ? 1 : 0;
  $role_id = isset($_POST["role_id"]) ? intval($_POST["role_id"]) : null;

  if (!$staff_id) {
    echo "<script>alert('Staff ID is required.'); window.location.href='/brgy_tx_prot/views/admin/manage-staff.php';</script>";
    exit();
  }

  if ($password !== null && $confirm_password !== null && $password !== $confirm_password) {
    echo "<script>alert('Passwords do not match.'); window.location.href='/brgy_tx_prot/views/admin/manage-staff.php';</script>";
    exit();
  }

  $staffModel = new Staff($conn);
  $staffData = $staffModel->getStaffByID($staff_id);

  if (!$staffData) {
    echo "<script>alert('Invalid staff ID.'); window.location.href='/brgy_tx_prot/views/admin/manage-staff.php';</script>";
    exit();
  }

  $success = $staffModel->updateStaff($staff_id, $password, $is_active, $role_id);

  if ($success) {
    echo "<script>alert('Staff account updated successfully.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=manage-staff-accounts';</script>";
  } else {
    echo "<script>alert('Failed to update staff account.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php';</script>";
  }

  exit();
}
