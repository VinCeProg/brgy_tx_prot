 <?php
  $pagetitle = 'Complaints';
  session_start();
  // require("../../config/staff-auth.php"); //for login auth
  require("../../functions.php");
  require("partials/html.head.php");
  require __DIR__ . "/../../config/database.php";
  require __DIR__ . "/../../src/models/Ticket.php";
  require __DIR__ . "/../../src/models/TicketLog.php";
  $ticketModel = new Ticket($conn);
  $ticket = $ticketModel->getTicketByTicketID($_GET['id']);
  $ticket_id = $_GET['id'];

  $staffModel = new StaffMessage($conn);
  $residentModel = new ResidentMessage($conn);
  $logModel = new TicketLog($conn);

  $staffMsgs = $staffModel->getMessageByTicket($ticket_id);
  $residentMsgs = $residentModel->getMessageByTicket($ticket_id);
  $logs = $logModel->getLogsByTicketID($ticket_id);

  $combined = [];

  foreach ($staffMsgs as $msg) {
    $combined[] = ['type' => 'staff', 'data' => $msg, 'timestamp' => $msg['created_at']];
  }
  foreach ($residentMsgs as $msg) {
    $combined[] = ['type' => 'resident', 'data' => $msg, 'timestamp' => $msg['created_at']];
  }
  foreach ($logs as $log) {
    $combined[] = ['type' => 'log', 'data' => $log, 'timestamp' => $log['changed_at']];
  }

  usort($combined, fn($b, $a) => strtotime($a['timestamp']) <=> strtotime($b['timestamp']));

  // dd($_SERVER);
  ?>

 <body>
   <?php require("partials/navbar.php"); ?>

   <main style="display: flex">
     <?php require("partials/section.summary.php"); ?>
   </main>
   <script src="/brgy_tx_prot/public/js/status-colorcode.js"></script>
 </body>

 </html>