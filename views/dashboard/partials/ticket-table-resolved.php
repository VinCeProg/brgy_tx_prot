  <?php
  require("../../src/models/Ticket.php");
  require("../../config/database.php");
  $ticketModel = new Ticket($conn);
  $tickets = $ticketModel->getResolvedTickets();
  ?>

  <?php if (empty($tickets)): ?>
    <p>No tickets found.</p>
  <?php else: ?>
    <div class="resolved-controls">
      <div class="resolved-control-input">
        <label for="resolved-filter">Filter:</label>
        <select class="resolved-filter" id="resolved-filter">
          <option value="">All Issue Types</option>
          <?php
          $issueTypes = array_unique(array_column($tickets, 'issue_type'));
          foreach ($issueTypes as $type):
          ?>
            <option value="<?= htmlspecialchars($type) ?>"><?= htmlspecialchars($type) ?></option>
          <?php endforeach; ?>
        </select>
      </div>
      <div class="resolved-control-input">
        <label for="resolved-search">Search: </label>
        <input type="text" class="resolved-search" id="resolved-search" placeholder="Search by subject...">
      </div>
    </div>
    <div class="table-container">
      <table>
        <caption style="font-size: 2rem; font-weight: bold; color: white; margin: 0 0 1rem 0">
          RESOLVED BARANGAY TICKETS
        </caption>
        <thead>
          <tr>
            <th>Issue Type</th>
            <th>Subject</th>
            <th>Status</th>
            <th>Date Resolved</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($tickets as $ticket): ?>
            <tr>
              <td><?= htmlspecialchars($ticket['issue_type']) ?></td>
              <td><?= htmlspecialchars($ticket['subject']) ?></td>
              <td><?= ucfirst(htmlspecialchars($ticket['status'])) ?></td>
              <td><?= htmlspecialchars($ticket['updated_at']) ?></td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>
  <?php endif; ?>

  <script>
    const filterInput = document.getElementById('resolved-filter');
    const searchInput = document.getElementById('resolved-search');
    const rows = document.querySelectorAll('.table-container tbody tr');

    function filterTable() {
      const filterValue = filterInput.value.toLowerCase();
      const searchValue = searchInput.value.toLowerCase();

      rows.forEach(row => {
        const issueType = row.children[0].textContent.toLowerCase();
        const subject = row.children[1].textContent.toLowerCase();

        const matchesFilter = !filterValue || issueType === filterValue;
        const matchesSearch = subject.includes(searchValue);

        row.style.display = matchesFilter && matchesSearch ? '' : 'none';
      });
    }

    filterInput.addEventListener('change', filterTable);
    searchInput.addEventListener('input', filterTable);
  </script>