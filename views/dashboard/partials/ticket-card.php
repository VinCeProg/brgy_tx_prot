<?php if (empty($tickets)): ?>
  <p>You haven’t submitted any tickets yet. Create a <a href="submission.php">new request</a> to get started!</p> <br> <br>
<?php else: ?>
  <?php foreach ($tickets as $ticket): ?>
    <div class="ticket-container">
      <h2>Ticket #: <?= htmlspecialchars($ticket['ticket_id']) ?></h2>
      <h1><?= htmlspecialchars($ticket['subject']) ?></h1>
      <p><strong>STATUS: <span class="status-text"><?= strtoupper(htmlspecialchars($ticket['status'])) ?></span></strong></p> <br>
      <a href="<?= htmlspecialchars($ticket['file_path']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($ticket['file_path']) ?>">
      </a>
      <h2>Date Requested : <small><?= htmlspecialchars($ticket['created_at']) ?></small></h2>
      <p><?= htmlspecialchars($ticket['description']) ?></p>
      <p class="note"><strong>Updated Last: </strong><?= htmlspecialchars($ticket['updated_at']) ?></p>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<script src="/brgy_tx_prot/public/js/status-colorcode.js">
</script>
