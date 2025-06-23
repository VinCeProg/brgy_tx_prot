<?php
session_start(); // Start the session to access it

// Unset only resident-related session variables
unset($_SESSION['resident']);
unset($_SESSION['is_logged_in']);

header("Location: /brgy_tx_prot/views/login.php"); // Redirect to login page
exit();
