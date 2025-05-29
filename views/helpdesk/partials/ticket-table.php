<?php if (empty($tickets)): ?>
  <p>No tickets found.</p>
<?php else: ?>
  <!-- <h2>RECENT TICKETS</h2> -->
  <div class="table-container">
    <table class="box-shadow" style="table-layout: fixed;">
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
          <th>Action</th>
        </tr>
      </thead>
      <tbody>
        <?php foreach ($tickets as $ticket): ?>
          <tr>
            <td><?= htmlspecialchars($ticket['ticket_id']) ?></td>
            <td class="priority-display"><?= htmlspecialchars($ticket['priority_level']) ?></td>
            <td><?= htmlspecialchars($ticket['issue_type']) ?></td>
            <td><?= htmlspecialchars($ticket['FullName']) ?></td>
            <td><?= htmlspecialchars($ticket['subject']) ?></td>
            <td><?= htmlspecialchars($ticket['issue_address']) ?></td>
            <td class="status-text"><?= ucfirst(htmlspecialchars($ticket['status'])) ?></td>
            <td><?= htmlspecialchars($ticket['created_at']) ?></td>
            <td>
              <a href="/brgy_tx_prot/views/helpdesk/view-ticket.php?id=<?= htmlspecialchars($ticket['ticket_id']) ?>" class="view-btn">View Ticket</a>
            </td>
          </tr>
        <?php endforeach; ?>
      </tbody>
    </table>
  </div>
<?php endif; ?>