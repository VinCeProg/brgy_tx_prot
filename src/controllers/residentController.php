<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/Resident.php';

$resident = new Resident($conn);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $data = [
    'first_name' => cleanInput($_POST['firstname']),
    'last_name' => cleanInput($_POST['lastname']),
    'address' => cleanInput($_POST['address']),
    'email' => cleanInput($_POST['email']),
    'phone_no' => cleanInput($_POST['phone']),
    'password' => $_POST['password']
  ];

  if ($resident->createResident($data)) {
    header("Location: ../../templates/dashboard.php");
    exit();
  } else {
    echo "Error in registration";
  }
}

function cleanInput($value) {
  return htmlspecialchars(trim($value), ENT_QUOTES, 'UTF-8');
}