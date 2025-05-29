  <?php
  require("../src/controllers/ticketController.php");
  require("../config/database.php");
  $ticketModel = new Ticket($conn);
  $tickets = $ticketModel->getResolvedTickets();
  ?>

  <?php if (empty($tickets)): ?>
    <p>No tickets found.</p>
  <?php else: ?>
    <div class="table-container">
      <table>
        <thead>
          <tr>
            <th>Issue Type</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Date Resolved</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $ticket): ?>
            <tr>
              <td><?= htmlspecialchars($ticket['issue_type']) ?></td>
              <td><?= htmlspecialchars($ticket['subject']) ?></td>
              <td><?= ucfirst(htmlspecialchars($ticket['status'])) ?></td>
              <td><?= htmlspecialchars($ticket['updated_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>