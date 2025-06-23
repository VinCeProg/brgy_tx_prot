<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pagetitle = 'Reporting';
require("../../config/staff-auth.php"); //for login auth
require("../../functions.php");
require("partials/html.head.php");
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../src/models/Ticket.php";

if (!$_SESSION['staff_permissions']['generate_report']) {
  header("/brgy_tx_prot/views/helpdesk/index.php");
  exit();
}

$ticketModel = new Ticket($conn);

$startDate = $_GET['start_date'] ?? null;
$endDate = $_GET['end_date'] ?? null;
$status    = $_GET['status'] ?? null;
$priority  = $_GET['priority'] ?? null;

$tickets = $ticketModel->getFilteredTickets($startDate, $endDate, $status, $priority);
// dd($tickets);
?>

<!-- SheetJS for Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<!-- html2pdf for PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>


<body style="padding: 4px;">

  <?php require("partials/navbar.php"); ?>

  <div class="report-wrapper">
    <h1 style="margin: 12px;">Generate Ticket Report</h1>

    <form method="GET" class="styled-report-filter">
      <label>
        From:
        <input type="date" name="start_date" value="<?= htmlspecialchars($startDate ?? '') ?>">
      </label>

      <label>
        To:
        <input type="date" name="end_date" value="<?= htmlspecialchars($endDate ?? '') ?>">
      </label>

      <label>
        Status:
        <select name="status">
          <option value="all">All</option>
          <option value="Pending" <?= ($status ?? '') === 'Pending' ? 'selected' : '' ?>>Pending</option>
          <option value="In Progress" <?= ($status ?? '') === 'In Progress' ? 'selected' : '' ?>>In Progress</option>
          <option value="Resolved" <?= ($status ?? '') === 'Resolved' ? 'selected' : '' ?>>Resolved</option>
        </select>
      </label>

      <label>
        Priority:
        <select name="priority">
          <option value="all">All</option>
          <option value="Low" <?= ($priority ?? '') === 'Low' ? 'selected' : '' ?>>Low</option>
          <option value="Medium" <?= ($priority ?? '') === 'Medium' ? 'selected' : '' ?>>Medium</option>
          <option value="High" <?= ($priority ?? '') === 'High' ? 'selected' : '' ?>>High</option>
          <option value="Urgent" <?= ($priority ?? '') === 'Urgent' ? 'selected' : '' ?>>Urgent</option>
        </select>
      </label>

      <button type="submit">Filter</button>
      <div>
        <button id="export-excel">Export to Excel</button>
        <!-- <button id="export-pdf">Export to PDF</button> -->
      </div>
    </form>
  </div>

  <table class="ticket-table">
    <thead>
      <tr>
        <th>ID</th>
        <th>Subject</th>
        <th>Status</th>
        <th>Priority</th>
        <th>Requested By</th>
        <th>Created At</th>
      </tr>
    </thead>
    <tbody>
      <?php if (!empty($tickets)): ?>
        <?php foreach ($tickets as $ticket): ?>
          <tr>
            <td><?= htmlspecialchars($ticket['ticket_id']) ?></td>
            <td><?= htmlspecialchars($ticket['subject']) ?></td>
            <td><?= htmlspecialchars($ticket['status']) ?></td>
            <td><?= htmlspecialchars($ticket['priority_level']) ?></td>
            <td><?= htmlspecialchars($ticket['fullname']) ?></td>
            <td><?= htmlspecialchars($ticket['created_at']) ?></td>
          </tr>
        <?php endforeach; ?>
      <?php else: ?>
        <tr>
          <td colspan="5">No tickets found for this date range.</td>
        </tr>
      <?php endif; ?>
    </tbody>
  </table>

  <script>
    function getTimestampedFilename(baseName, extension) {
      const now = new Date();
      const dateStr = now.toISOString().replace(/T/, '_').replace(/:/g, '-').replace(/\..+/, '');
      return `${baseName}_${dateStr}.${extension}`;
    }

    document.getElementById("export-excel").addEventListener("click", function() {
      const table = document.querySelector(".ticket-table");
      const wb = XLSX.utils.table_to_book(table, {
        sheet: "Tickets"
      });
      const filename = getTimestampedFilename("ticket_report", "xlsx");
      XLSX.writeFile(wb, filename);
    });

    document.getElementById("export-pdf").addEventListener("click", function() {
      const table = document.querySelector(".ticket-table");

      const filename = getTimestampedFilename("ticket_report", "pdf");

      const opt = {
        margin: 0.5,
        filename: filename,
        image: {
          type: 'jpeg',
          quality: 0.98
        },
        html2canvas: {
          scale: 2
        },
        jsPDF: {
          unit: 'in',
          format: 'a4',
          orientation: 'landscape'
        }
      };

      html2pdf().set(opt).from(table).save();
    });
  </script>
</body>

</html>