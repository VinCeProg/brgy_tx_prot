<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Resident.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $resident_id = isset($_POST['resident_id']) ? intval($_POST['resident_id']) : null;
  $firstName   = trim($_POST['first_name'] ?? '');
  $lastName    = trim($_POST['last_name'] ?? '');
  $address     = trim($_POST['address'] ?? '');
  $email       = trim($_POST['email'] ?? '');
  $phone       = trim($_POST['phone'] ?? '');
  $password    = !empty($_POST['password']) ? $_POST['password'] : null;
  $confirmPass = $_POST['confirm_password'] ?? null;

  if (!$resident_id) {
    echo "<script>alert('Resident ID is required.'); window.location.href='/brgy_tx_prot/views/admin/manage-residents.php';</script>";
    exit();
  }

  if ($password !== null && $password !== $confirmPass) {
    echo "<script>alert('Passwords do not match.'); window.location.href='/brgy_tx_prot/views/admin/manage-residents.php';</script>";
    exit();
  }

  $residentModel = new Resident($conn);
  $success = $residentModel->updateResident(
    $resident_id,
    $firstName,
    $lastName,
    $address,
    $email,
    $phone,
    $password
  );

  if ($success) {
    echo "<script>alert('Resident updated successfully.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=manage-resident-accounts';</script>";
  } else {
    echo "<script>alert('Failed to update resident.'); window.location.href='/brgy_tx_prot/views/helpdesk/configuration-view/index.php?page=manage-residents-accounts';</script>";
  }

  exit();
}
