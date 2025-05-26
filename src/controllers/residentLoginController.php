<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Resident.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email-login']);
  $password = $_POST['password-login'];

  // Validate user input
  if (empty($email) || empty($password)) {
    $_SESSION['error'] = "All fields are required.";
    header("Location: /brgy_tx_prot/views/login.php");
    exit();
  }

  $resident = new Resident($conn);
  $residentData = $resident->getByEmail($email);
  if ($residentData && password_verify($password, $residentData['Password'])) {
    unset($residentData['Password']);
    $_SESSION['resident'] = $residentData;
    $_SESSION['is_logged_in'] = true;

    header("Location: /brgy_tx_prot/views/login.php");
    exit();
  } else {
    echo "<script>
        alert('Invalid email or password.');
        window.location.href='/brgy_tx_prot/views/dashboard.php';</script>
        </script>";
  }
}
