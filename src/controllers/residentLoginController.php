<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Resident.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $email = trim($_POST['email']);
  $password = $_POST['password'];

  $resident = new Resident($conn);
  $residentData = $resident->getByEmail($email);
  if ($residentData && password_verify($password, $residentData['Password'])) {
    unset($residentData['Password']);
    echo "Welcome {$residentData['FirstName']}!";
  } else {
    echo "<script>
        alert('Invalid email or password.');
        window.location.href='/brgy_tx_prot/views/dashboard.php';</script>
        </script>";
  }
}
