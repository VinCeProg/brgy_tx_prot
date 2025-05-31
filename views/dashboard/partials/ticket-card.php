<?php if (empty($tickets)): ?>
  <p>You haven’t submitted any tickets yet. Create a <a href="submission.php">new request</a> to get started!</p><br><br>
<?php else: ?>
  <?php foreach ($tickets as $ticket): ?>
    <?php $tid = htmlspecialchars($ticket['ticket_id']); ?>
    <div class="ticket-container">
      <h2>Ticket #: <?= $tid ?></h2>
      <h1><?= htmlspecialchars($ticket['subject']) ?></h1>
      <p><strong>STATUS: <span class="status-text"><?= strtoupper(htmlspecialchars($ticket['status'])) ?></span></strong></p><br>
      <a href="<?= htmlspecialchars($ticket['file_path']) ?>" target="_blank">
        <img src="<?= htmlspecialchars($ticket['file_path']) ?>">
      </a>
      <h2>Date Requested : <small><?= htmlspecialchars($ticket['created_at']) ?></small></h2>
      <p><?= htmlspecialchars($ticket['description']) ?></p>
      <p class="note"><strong>Updated Last: </strong><?= htmlspecialchars($ticket['updated_at']) ?></p>
      <button popovertarget="msg-popover-<?= $tid ?>">View Updates</button>
    </div>

    <div id="msg-popover-<?= $tid ?>" popover class="message-popover" style="margin: auto; padding: 24px">
      <h4>Messages for Ticket #<?= $tid ?></h4>
      <div class="message-log" id="message-log-<?= $tid ?>">
        Loading messages...
      </div>
    </div>
  <?php endforeach; ?>
<?php endif; ?>

<script src="/brgy_tx_prot/public/js/status-colorcode.js"></script>
<script>
  document.querySelectorAll('[popovertarget]').forEach(button => {
    button.addEventListener('click', async () => {
      const popoverId = button.getAttribute('popovertarget');
      const ticketId = popoverId.split('-').pop();
      const container = document.getElementById(`message-log-${ticketId}`);
      container.innerHTML = 'Loading messages...';

      try {
        const response = await fetch(`/brgy_tx_prot/src/controllers/getMessagesController.php?ticket_id=${ticketId}`);
        const data = await response.text();
        container.innerHTML = data;
      } catch (error) {
        container.innerHTML = 'Failed to load messages.';
        console.error(error);
      }
    });
  });
</script>