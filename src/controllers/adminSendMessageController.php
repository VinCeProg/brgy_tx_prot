<?php
session_start();
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);
define('BASE_PATH', realpath(__DIR__ . '/../../'));
require BASE_PATH . '/config/database.php';
require BASE_PATH . '/src/models/TicketLog.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $ticket_id = intval($_POST['ticket_id']);
    $staff_id = $_SESSION['staff']['staff_id'];
    $message = trim($_POST['message']);

    if (empty($message)) {
        $_SESSION['error'] = "Message cannot be empty.";
        header("Location: /brgy_tx_prot/views/helpdesk/view-ticket.php?id=$ticket_id");
        exit();
    }

    $model = new StaffMessage($conn);
    if ($model->sendMessage($ticket_id, $staff_id, $message)) {
        $_SESSION['success'] = "Message sent successfully.";
    } else {
        $_SESSION['error'] = "Failed to send message.";
    }

    echo "<script>alert(`Message Sent!`); window.location.href='/brgy_tx_prot/views/helpdesk/view-ticket.php?id=$ticket_id';</script>";
    exit();
}
