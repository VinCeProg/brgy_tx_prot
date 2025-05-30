<?php
$ticketModel = new Ticket($conn);
$tickets = $ticketModel->getAllTicketsWithFullName();
$status_count = $ticketModel->getTicketStatusCount();
$priorityLvl_count = $ticketModel->getTicketPriorityCount();
$txPerDay_count = $ticketModel->getTicketCountsPerDay();
?>

<div class="dashboard">
  <div class="dashboard-top box-shadow">
    <h3>DASHBOARD</h3>
  </div>

  <div class="cards-container">
    <div class="request-summary box-shadow">
      <div class="request-item">
        <span class="label">
          <h4>TOTAL REQUESTS</h4>
        </span>
        <div class="number-box"><?= array_sum($status_count) ?></div>
      </div>
      <div class="request-item">
        <span class="label">URGENT</span>
        <div class="number-box urgent-box"><?= $priorityLvl_count['Urgent'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">HIGH PRIORITY</span>
        <div class="number-box high-box"><?= $priorityLvl_count['High'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">MEDIUM PRIORITY</span>
        <div class="number-box med-box"><?= $priorityLvl_count['Medium'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">LOW PRIORITY</span>
        <div class="number-box low-box"><?= $priorityLvl_count['Low'] ?></div>
      </div>
    </div>
    <div class="chart-wrapper box-shadow">
      <canvas id="status-chart"></canvas>
    </div>

    <div class="summary-container">
      <div class="summary">
        <h4>PENDING</h4>
        <p><?= $status_count['pending'] ?></p>
      </div>
      <div class="summary">
        <h4>IN PROGRESS</h4>
        <p><?= $status_count['in progress'] ?></p>
      </div>
      <div class="summary">
        <h4>RESOLVED</h4>
        <p><?= $status_count['resolved'] ?></p>
      </div>
    </div>
    <div class="chart-wrapper box-shadow">
      <canvas id="tx-per-day-chart"></canvas>
    </div>
  </div>

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
</div>

<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
<script>
  const xValues = <?php echo json_encode(array_keys($priorityLvl_count)) ?>;
  const yValues = <?php echo json_encode(array_values($priorityLvl_count)) ?>;

  const ctx = document.getElementById('status-chart').getContext('2d');
  const chart = new Chart(ctx, {
    type: 'bar',
    data: {
      labels: xValues,
      datasets: [{
        label: 'Ticket Count per Priority Level',
        data: yValues,
        backgroundColor: [
          '#237d32',
          '#f9a825',
          '#ef6c00',
          '#c62828'
        ],
        borderColor: [
          '#237d32',
          '#f9a825',
          '#ef6c00',
          '#c62828'
        ],
        borderWidth: 1
      }]
    },
    options: {
      plugins: {
        legend: {
          display: true
        }
      },
      scales: {
        y: {
          beginAtZero: true,
          precision: 0
        }
      }
    }
  });
</script>

<script>
  const linechart = new Chart(document.getElementById('tx-per-day-chart'), {
    type: 'line',
    data: {
      labels: <?= json_encode($txPerDay_count['dates']) ?>,
      datasets: [{
        label: 'Tickets Submitted Per Day',
        data: <?= json_encode($txPerDay_count['counts']) ?>,
        borderColor: 'rgba(75, 192, 192, 1)',
        backgroundColor: 'rgba(75, 192, 192, 0.2)',
        fill: true,
        tension: 0.4
      }]
    },
    options: {
      responsive: true,
      scales: {
        y: {
          beginAtZero: true
        }
      }
    }
  });
</script>