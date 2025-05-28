  <?php
  require("../../src/controllers/ticketController.php");
  require("../../config/database.php");
  $ticketModel = new Ticket($conn);
  $tickets = $ticketModel->getAllTicketsWithFullName();
  ?>

  <?php if (empty($tickets)): ?>
    <p>No tickets found.</p>
  <?php else: ?>
    <div class="ticket-container">
      <table>
        <thead>
          <tr>
            <th>Ticket ID</th>
            <th>Priority Level</th>
            <th>Issue Type</th>
            <th>Submitted by</th>
            <th>Subject</th>
            <th>Address</th>
            <th>Status</th>
            <th>Created At</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $ticket): ?>
            <tr>
              <td><?= htmlspecialchars($ticket['ticket_id']) ?></td>
              <td><?= htmlspecialchars($ticket['priority_level']) ?></td>
              <td><?= htmlspecialchars($ticket['issue_type']) ?></td>
              <td><?= htmlspecialchars($ticket['FullName']) ?></td>
              <td><?= htmlspecialchars($ticket['subject']) ?></td>
              <td><?= htmlspecialchars($ticket['issue_address']) ?></td>
              <td><?= ucfirst(htmlspecialchars($ticket['status'])) ?></td>
              <td><?= htmlspecialchars($ticket['created_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>