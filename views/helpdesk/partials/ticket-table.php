<?php if (empty($tickets)): ?>
  <p>No tickets found.</p>
<?php else: ?>
  <!-- <h2>RECENT TICKETS</h2> -->

  <div class="table-container">
    <div class="filter-wrapper">
      <h2 style="color: white;">Ticket Management</h2>
      <div class="input-filter-wrapper">
        <div class="input-filter-container">
          <label>Sort by:</label>
          <select id="sortColumn">
            <option value="0">Ticket ID</option>
            <option value="1">Priority Level</option>
            <option value="2">Issue Type</option>
            <option value="3">Subject</option>
            <option value="4">Address</option>
            <option value="5">Status</option>
            <option value="6">Submitted by</option>
            <option value="7">Created At</option>
          </select>
          <button class="box-shadow btn" id="sortOrderBtn" onclick="toggleSortOrder()">Asc</button>
          <button class="box-shadow btn" id="resetSortBtn">Reset</button>
        </div>
        <div class="input-filter-container">
          <label>Search</label>
          <input type="text" id="searchInput" placeholder="Search tickets..." onkeyup="filterTable()">
        </div>
      </div>
    </div>

    <table class="box-shadow" style="table-layout: fixed;">
      <thead>
        <tr>
          <th>Ticket ID</th>
          <th>Priority Level</th>
          <th>Issue Type</th>
          <th>Subject</th>
          <th>Address</th>
          <th>Status</th>
          <th>Submitted by</th>
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
            <td><?= htmlspecialchars($ticket['subject']) ?></td>
            <td><?= htmlspecialchars($ticket['issue_address']) ?></td>
            <td class="status-text"><?= ucfirst(htmlspecialchars($ticket['status'])) ?></td>
            <td><?= htmlspecialchars($ticket['FullName']) ?></td>
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