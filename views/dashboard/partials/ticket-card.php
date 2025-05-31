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
      <button popovertarget="msg-popover-<?= $tid ?>" class="popover-button">View Logs</button>
    </div>

    <div id="msg-popover-<?= $tid ?>" popover class="message-popover" style="margin: auto; padding: 24px">
      <button popovertarget="msg-popover-<?= $tid ?>" class="popover-button">CLOSE</button> <br> <br>
      <form id="messageForm" action="/brgy_tx_prot/src/controllers/residentSendMessageController.php" method="POST" class="message-form">
        <input type="hidden" name="ticket_id" value="<?= $tid ?>">
        <input type="hidden" name="resident_id" value="<?= htmlspecialchars($_SESSION['resident']['UserID']) ?>">

        <label for="message">Message:</label>
        <textarea name="message" id="message" required class="message-box"></textarea>

        <button type="submit" class="send-button">Send Message</button>
      </form> <br>

      <h4>Logs for Ticket #<?= $tid ?></h4>
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