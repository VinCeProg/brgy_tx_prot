<?php

session_start();
if (!isset($_SESSION['is_staff_logged_in']) || $_SESSION['is_staff_logged_in'] !== true) {
    header("Location: /brgy_tx_prot/views/helpdesk/login.php"); 
    exit();
}
