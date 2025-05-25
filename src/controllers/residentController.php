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
    'first_name' => $_POST['firstname'],
    'last_name' => $_POST['lastname'],
    'address' => $_POST['address'],
    'email' => $_POST['email'],
    'phone_no' => $_POST['phone'],
    'password' => $_POST['password']
  ];

  if ($resident->createResident($data)) {
    header("Location: ../../public/dashboard.php");
    exit();
  } else {
    echo "Error in registration";
  }
}
