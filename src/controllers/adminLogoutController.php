<?php
session_start(); // Start the session to access it

unset($_SESSION['staff']);
unset($_SESSION['staff_permissions']);
unset($_SESSION['is_staff_logged_in']);

header("Location: /brgy_tx_prot/views/helpdesk/login.php"); // Redirect to login page
exit();
