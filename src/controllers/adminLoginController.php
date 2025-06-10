<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Staff.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $staff_id = intval($_POST['staff_id']);
  $password = $_POST['password'];

  // Validate user input
  if (empty($staff_id) || empty($password)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: /brgy_tx_prot/views/helpdesk/login.php");
    exit();
  }

  $staff = new Staff($conn);
  $staff_data = $staff->getStaffByID($staff_id);

  if (!$staff_data['is_active']) {
    echo "<script>
        alert('Staff Account Inactive.');
        window.location.href='/brgy_tx_prot/views/helpdesk/login.php';</script>
        </script>";
    exit();
  }

  if ($staff_data && password_verify($password, $staff_data['password'])) {
    unset($staff_data['password']);
    $_SESSION['staff'] = $staff_data;
    $_SESSION['is_staff_logged_in'] = true;

    header("Location: /brgy_tx_prot/views/helpdesk/index.php");
    exit();
  } else {
    echo "<script>
        alert('Invalid staff ID or password.');
        window.location.href='/brgy_tx_prot/views/helpdesk/login.php';</script>
        </script>";
  }
}
