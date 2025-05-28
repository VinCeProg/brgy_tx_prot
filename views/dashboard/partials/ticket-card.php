<?php if (empty($tickets)): ?>
  <p>You haven’t submitted any tickets yet. Create a <a href="submission.php">new request</a> to get started!</p> <br> <br>
<?php else: ?>
  <?php foreach ($tickets as $ticket): ?>
    <div class="ticket-container">
      <h2>Ticket #: <?= htmlspecialchars($ticket['ticket_id']) ?></h2>
      <h1><?= htmlspecialchars($ticket['subject']) ?></h1>
      <p><strong>STATUS: <?= strtoupper(htmlspecialchars($ticket['status'])) ?></strong></p> <br>
      <a href="<?= htmlspecialchars($ticket['file_path']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($ticket['file_path']) ?>">
      </a>
      <h2><?= htmlspecialchars($ticket['issue_type']) ?></h2>
      <p><?= htmlspecialchars($ticket['description']) ?></p>
      <p><?= htmlspecialchars($ticket['created_at']) ?></p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>