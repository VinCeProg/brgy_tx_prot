<?php
session_start(); // Start the session to access it

session_unset(); // Remove all session variables
session_destroy(); // Completely destroy the session

header("Location: /brgy_tx_prot/index.php"); // Redirect to login page
exit();
