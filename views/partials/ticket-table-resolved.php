  <?php
  require("../src/models/Ticket.php");
  require("../config/database.php");
  $ticketModel = new Ticket($conn);
  $tickets = $ticketModel->getResolvedTickets();
  ?>

  <?php if (empty($tickets)): ?>
    <p>No tickets found.</p>
  <?php else: ?>
    <div class="table-container">
      <table>
        <caption style="font-size: 2rem; font-weight: bold; color: white; margin: 0 0 1rem 0">
          RESOLVED BARANGAY TICKETS
        </caption>
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