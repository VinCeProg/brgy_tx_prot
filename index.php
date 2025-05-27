<?php
session_start(); // Always start session before checking login status
require("functions.php");
// Redirect logged-in users to the dashboard
if (isset($_SESSION['is_logged_in']) && $_SESSION['is_logged_in'] == true) {
    header("Location: /brgy_tx_prot/views/dashboard.php");
    exit(); // Stop execution after redirect
}

// Redirect non-logged-in users to homepage
header("Location: /brgy_tx_prot/views/index.view.php");
exit();
