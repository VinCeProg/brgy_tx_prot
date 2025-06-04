<?php
$ticketModel = new Ticket($conn);
$resolvedTicketList = $ticketModel->getNoDisplayResolvedTickets();
?>
<!-- <pre>
<?php print_r($resolvedTicketList) ?>
</pre> -->

<div class="resident-page-title">
  <h1>Add Resolved Tickets Display</h1>
  <p>Here, you can add display for resolved tickets.</p>
</div>
<br>
<div class="upload-form">
  <?php if (!empty($errors)): ?>
    <div class="error"><?= implode("<br>", $errors) ?></div>
  <?php endif; ?>
  <form action="/brgy_tx_prot/src/controllers/adminUploadDisplayController.php" method="POST" enctype="multipart/form-data">
    <label for="ticket_id">Resolved Ticket</label>
    <select name="ticket_id" required>
      <option value="">-- Select Ticket --</option>
      <?php foreach ($resolvedTicketList as $ticket): ?>
        <option value="<?= htmlspecialchars($ticket['ticket_id']) ?>">
          <?= htmlspecialchars($ticket['ticket_id'] . ' - ' . $ticket['subject']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label for="subject">Subject</label>
    <input type="text" name="subject" required minlength="8" maxlength="64">

    <label for="description">Description</label>
    <textarea name="description" rows="5" required minlength="8" maxlength="256"></textarea>
    <p class="note"><em><strong>Note: </strong> Subject limit: 64 characters. Description limit: 256 characters</em></p>

    <label for="file_path">File Upload</label>
    <input type="file" name="file_path" accept="image/*">
    <br>
    <button type="submit">Upload</button>
  </form>
</div>