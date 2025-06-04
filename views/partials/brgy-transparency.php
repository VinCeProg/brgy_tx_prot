<?php
if ($_SERVER['REQUEST_URI'] == "/brgy_tx_prot/views/index.view.php") {
  require("../config/database.php");
  require("../src/models/DisplayTicket.php");
} else {
  require("../../config/database.php");
  require("../../src/models/DisplayTicket.php");
}
$displayTicketModel = new DisplayTicket($conn);
$displayTickets = $displayTicketModel->getAllVisibleDisplayTickets();
?>

<div class="title-container" id="transparency-service">
  <p>INNOVATIVE PUBLIC SERVICE</p>
  <h3>TRANSPARENCY & GOOD GOVERNANCE</h3>
</div>

<div class="carousel-wrapper">
  <div class="carousel-container" aria-label="Scrolling carousel of governance images">
    <div class="carousel">
      <?php for ($i = 0; $i < 2; $i++): ?>
        <?php foreach ($displayTickets as $displayTicket): ?>
          <div class="card hidden-card">
            <div class="image-wrapper">
              <img src="<?= $displayTicket['file_path'] ?>" alt="image of fixed issue: <?= htmlspecialchars($displayTicket['subject']) ?>">
              <div class="overlay"></div>
            </div>
            <h3><?= htmlspecialchars($displayTicket['subject']) ?></h3>
            <p><?= htmlspecialchars($displayTicket['description']) ?></p>
          </div>
        <?php endforeach; ?>
      <?php endfor; ?>
    </div>
  </div>
</div>