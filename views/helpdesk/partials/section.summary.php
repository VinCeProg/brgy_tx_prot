<?php
// dd($ticket);
?>

<section class="ticket-summary">
  <div class="ticket-view box-shadow">
    <div class="header">
      <div>
        <h2><?= $ticket['subject'] ?></h2>
        <p>
          <strong>Priority:</strong>
          <span class="priority-display"><?= $ticket['priority_level'] ?></span>
        </p>
        <p>
          <strong>Ticket No.</strong>
          <?= $ticket['ticket_id'] ?>
        </p>
        <p>
          <strong>Address:</strong>
          <span class="faded"><?= $ticket['issue_address'] ?></span>
        </p>
        <p>
          <strong>Description:</strong> <br>
          <span class="faded"><?= $ticket['description'] ?></span>
        </p>
      </div>

      <div class="right-column">
        <p>
          <strong>Resident’s Name:</strong>
          <?= $ticket['FullName'] ?>
        </p>
        <p>
          <strong>Phone Number:</strong>
          <?= $ticket['PhoneNo'] ?>
        </p>
        <p>
          <strong>Email:</strong>
          <?= $ticket['Email'] ?>
        </p>
        <p class="status">
          <?= $ticket['created_at'] ?>
          <br>
          <span id="status-display" class="<?= $ticket['status'] ?> status-text" style="font-weight: bold;"><?= strtoupper($ticket['status']) ?></span>
        </p>
        <button onclick="toggleEdit()" class="edit-btn" title="Edit Ticket">Edit</button>
      </div>
    </div>

    <form method="POST" action="/brgy_tx_prot/src/controllers/ticketUpdateController.php" class="edit-form hidden" id="edit-form">
      <input type="hidden" name="ticket_id" value="<?= $ticket['ticket_id'] ?>">
      <label>Status: <br>
        <select name="status">
          <option <?= strtolower($ticket['status']) == 'pending' ? 'selected' : '' ?>>Pending</option>
          <option <?= strtolower($ticket['status']) == 'in progress' ? 'selected' : '' ?>>In Progress</option>
          <option <?= strtolower($ticket['status']) == 'resolved' ? 'selected' : '' ?>>Resolved</option>
        </select>
      </label>
      <label>Priority: <br>
        <select name="priority_level">
          <option <?= strtolower($ticket['priority_level']) == 'low' ? 'selected' : '' ?>>Low</option>
          <option <?= strtolower($ticket['priority_level']) == 'medium' ? 'selected' : '' ?>>Medium</option>
          <option <?= strtolower($ticket['priority_level']) == 'high' ? 'selected' : '' ?>>High</option>
          <option <?= strtolower($ticket['priority_level']) == 'urgent' ? 'selected' : '' ?>>Urgent</option>
        </select>
      </label>
      <input type="submit" name="update_ticket" title="Submit Edit"></input>
    </form>

    <br><br>
    <hr><br>

    <div class="photo-section">
      <p><strong>Photo / Video</strong></p>
      <a href="<?= $ticket['file_path'] ?>" target="_blank">
        <img src="<?= $ticket['file_path'] ?>" alt="Complaint Picture">
      </a>
    </div>
  </div>
</section>

<script>
  function toggleEdit() {
    const form = document.getElementById('edit-form');
    form.classList.toggle('hidden');
  }

  function applyChanges() {
    const status = document.getElementById('status-select').value;
    const priority = document.getElementById('priority-select').value;

    document.getElementById('status-display').innerText = status.toUpperCase();
    document.getElementById('status-display').className = status.toLowerCase();
    document.getElementById('priority-display').innerText = priority;

    toggleEdit();
  }
</script>