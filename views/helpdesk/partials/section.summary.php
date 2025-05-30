<?php
// dd($ticket);
?>

<section class="ticket-summary">
  <div class="ticket-view">
    <button onclick="window.location.href='/brgy_tx_prot/views/helpdesk/index.php';" class="back-btn" title="Go Back">
      <svg xmlns="http://www.w3.org/2000/svg" class="icon" viewBox="0 0 24 24" fill="none" stroke="currentColor">
        <path d="M15 18l-6-6 6-6" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
      </svg>
      back
    </button>
    <h1 class="ticket-subject"><?= $ticket['subject'] ?></h1>
    <table class="ticket-table" style="width: 95%; height: auto; margin: 12px 0;">
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
          <td colspan="3" class="faded" style="white-space: wrap;"><?= $ticket['description'] ?></td>
        </tr>
      </tbody>
    </table>

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
        <p><strong>Update Ticket</strong></p>
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

<section class="ticket-log-view">
  <div class="ticket-log-container">
    <form action="/brgy_tx_prot/src/controllers/adminSendMessageController.php" method="POST">
      <input type="hidden" name="ticket_id" value="<?= htmlspecialchars($ticket['ticket_id']) ?>">
      <textarea name="message" required placeholder="Type your message..."></textarea>
      <button type="submit">Send Message</button>
    </form>

    <div class="messages-container">
      <?php foreach ($combined as $entry): ?>
        <div class="message <?= htmlspecialchars($entry['type']) ?> <?= (htmlspecialchars($entry['type']) == 'staff' && $entry['data']['is_admin']) ? 'is-admin' : ''?>">
          <?php if ($entry['type'] !== 'log'): ?>
            <strong><?= htmlspecialchars($entry['data']['fullname']) ?></strong>
          <?php endif; ?>

          <span><?= htmlspecialchars($entry['timestamp']) ?></span>

          <p>
            <?php if ($entry['type'] === 'log'): ?>
              <?php if (strtolower($entry['data']['old_status']) !== strtolower($entry['data']['new_status'])): ?>
                Stage Changed: <strong><?= htmlspecialchars($entry['data']['old_status']) ?></strong> →
                <strong><?= htmlspecialchars($entry['data']['new_status']) ?></strong>
              <?php endif; ?>
              <?php if (strtolower($entry['data']['old_priority']) !== strtolower($entry['data']['new_priority'])): ?>
                Priority: <strong><?= htmlspecialchars($entry['data']['old_priority']) ?></strong> →
                <strong><?= htmlspecialchars($entry['data']['new_priority']) ?></strong>
              <?php endif; ?>
            <?php else: ?>
              <?= htmlspecialchars($entry['data']['message']) ?>
            <?php endif; ?>
          </p>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>