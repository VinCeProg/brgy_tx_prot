<?php

require '../../config/database.php';
require '../models/TicketLog.php';

if (!isset($_GET['ticket_id'])) {
  echo "No ticket ID provided.";
  exit;
}

$ticket_id = intval($_GET['ticket_id']);
$msgModel = new StaffMessage($conn);
$resMsgModel = new ResidentMessage($conn);
$logModel = new TicketLog($conn);

$staffMessages = $msgModel->getMessageByTicket($ticket_id);
$residentMessages = $resMsgModel->getMessageByTicket($ticket_id);
$logs = $logModel->getLogsByTicketID($ticket_id);

$allEntries = [];

// Combine all into a single array
foreach ($staffMessages as $msg) {
  $msg['type'] = 'staff';
  $msg['timestamp'] = $msg['created_at'];
  $allEntries[] = $msg;
}
foreach ($residentMessages as $msg) {
  $msg['type'] = 'resident';
  $msg['timestamp'] = $msg['created_at'];
  $allEntries[] = $msg;
}
foreach ($logs as $log) {
  $log['type'] = 'log';
  $log['timestamp'] = $log['changed_at'];
  $allEntries[] = $log;
}

// Sort chronologically
usort($allEntries, fn($a, $b) => strtotime($b['timestamp']) <=> strtotime($a['timestamp']));

// Output HTML
foreach ($allEntries as $entry) {
  echo "<div class='entry-container'>";

  if ($entry['type'] === 'staff') {
    echo "<p class='staff-entry'><strong>Staff:</strong> " . htmlspecialchars($entry['message']) . "</p>";
  } elseif ($entry['type'] === 'resident') {
    echo "<p class='resident-entry'><strong>You:</strong> " . htmlspecialchars($entry['message']) . "</p>";
  } elseif ($entry['type'] === 'log') {
    echo "<p class='log-entry'><em>Status changed from <strong>{$entry['old_status']}</strong> to <strong>{$entry['new_status']}</strong>";
    if ($entry['old_priority'] !== $entry['new_priority']) {
      echo " | Priority from <strong>{$entry['old_priority']}</strong> to <strong>{$entry['new_priority']}</strong>";
    }
    echo "</em></p>";
  }

  echo "<small class='timestamp'>{$entry['timestamp']}</small>";
  echo "</div>";
}
