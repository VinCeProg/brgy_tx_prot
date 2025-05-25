<?php
  $host = "localhost";
  $user = "root";
  $password = "";
  $database = "brgy_tx_system";

  $conn = new mysqli($host,$user,$password,$brgy_tx_system);

  if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
  }
?>