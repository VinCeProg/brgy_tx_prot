<?php
$ticketModel = new Ticket($conn);
$tickets = $ticketModel->getAllTicketsWithFullName();
$status_count = $ticketModel->getTicketStatusCount();
$priorityLvl_count = $ticketModel->getTicketPriorityCount();
?>

<div class="dashboard">
  <div class="dashboard-top box-shadow">
    <h3>DASHBOARD</h3>
    <!-- <div class="filters">
      <label>
        Filter by Issue Type:
        <select>
          <option>All Types</option>
        </select>
      </label>
      <label>
        Month:
        <select>
          <option value="0" selected disabled>Select</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </label>
    </div> -->
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
        <div class="number-box"><?= $priorityLvl_count['Urgent'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">HIGH PRIORITY</span>
        <div class="number-box"><?= $priorityLvl_count['High'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">MEDIUM PRIORITY</span>
        <div class="number-box"><?= $priorityLvl_count['Medium'] ?></div>
      </div>
      <div class="request-item">
        <span class="label">LOW PRIORITY</span>
        <div class="number-box"><?= $priorityLvl_count['Low'] ?></div>
      </div>
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
  </div>
</div>