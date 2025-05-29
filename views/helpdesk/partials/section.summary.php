<?php
// dd($ticket);
?>

<section class="ticket-summary">
  <div class="ticket-view box-shadow">
    <h1 class="ticket-subject"><?= $ticket['subject'] ?></h1>
    <table class="ticket-table">
      <tbody>
        <tr>
          <th>Priority:</th>
          <td class="priority-display"><?= $ticket['priority_level'] ?></td>
          <th>Resident’s Name:</th>
          <td><?= $ticket['FullName'] ?></td>
        </tr>
        <tr>
          <th>Ticket No.:</th>
          <td><?= $ticket['ticket_id'] ?></td>
          <th>Phone Number:</th>
          <td><?= $ticket['PhoneNo'] ?></td>
        </tr>
        <tr>
          <th>Address:</th>
          <td colspan="1" class="faded"><?= $ticket['issue_address'] ?></td>
          <th>Email:</th>
          <td><?= $ticket['Email'] ?></td>
        </tr>
        <tr>
          <th>Created At:</th>
          <td><?= $ticket['created_at'] ?></td>
          <th>Status:</th>
          <td>
            <span id="status-display" class="<?= $ticket['status'] ?> status-text">
              <?= strtoupper($ticket['status']) ?>
            </span>
          </td>
        </tr>
        <tr>
          <th>Description:</th>
          <td colspan="3" class="faded"><?= $ticket['description'] ?></td>
        </tr>
      </tbody>
    </table>
    <button onclick="toggleEdit()" class="edit-btn" title="Edit Ticket">Edit</button>

    <br><br>
    <hr>
    <div class="bottom-section">
      <div class="photo-section">
        <p><strong>Photo / Video</strong></p> <br>
        <a href="<?= $ticket['file_path'] ?>" target="_blank">
          <img src="<?= $ticket['file_path'] ?>" alt="Complaint Picture" class="box-shadow">
        </a>
      </div>

      <form method="POST" action="/brgy_tx_prot/src/controllers/ticketUpdateController.php" class="edit-form" id="edit-form">
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