<?php

session_start();
if (!isset($_SESSION['is_logged_in']) || $_SESSION['is_logged_in'] !== true) {
    header("Location: /brgy_tx_prot/views/login.php"); 
    exit(); // Stop execution after redirect
}
