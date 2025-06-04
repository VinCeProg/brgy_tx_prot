<?php
$displayModel = new DisplayTicket($conn);
$displayTickets = $displayModel->getAllDisplayTickets();
?>

<div class="resident-page-title">
  <h1>Manage Resolved Tickets Display</h1>
  <p>Control the display settings for resolved tickets.</p>
</div>
<div class="edit-display-form">
  <form id="editDisplayForm" method="POST" enctype="multipart/form-data" action="/brgy_tx_prot/src/controllers/adminUpdateDisplayController.php">
    <label for="display_id">Select Ticket to Edit:</label>
    <select name="display_id" id="display_id" required>
      <option value="">-- Select Ticket --</option>
      <?php foreach ($displayTickets as $ticket): ?>
        <option value="<?= $ticket['display_id'] ?>"
          data-subject="<?= htmlspecialchars($ticket['subject']) ?>"
          data-description="<?= htmlspecialchars($ticket['description']) ?>"
          data-visible="<?= $ticket['is_visible'] ?>">
          <?= htmlspecialchars($ticket['display_id']) . " - " . htmlspecialchars($ticket['subject']) ?>
        </option>
      <?php endforeach; ?>
    </select>

    <label>Subject:</label>
    <input type="text" name="subject" id="subject" required maxlength="64" />

    <label>Description:</label>
    <textarea name="description" id="description" rows="5" required maxlength="256"></textarea>

    <label>Replace Image (optional):</label>
    <input type="file" name="file_path" accept="image/*" />

    <label>
      <input type="checkbox" name="is_visible" id="is_visible" />
      Show on Display
    </label>

    <button type="submit">Update</button>
  </form>
</div>

<script>
  document.getElementById('display_id').addEventListener('change', function() {
    const selected = this.options[this.selectedIndex];
    document.getElementById('subject').value = selected.dataset.subject || '';
    document.getElementById('description').value = selected.dataset.description || '';
    document.getElementById('is_visible').checked = selected.dataset.visible == 1;
  });
</script>