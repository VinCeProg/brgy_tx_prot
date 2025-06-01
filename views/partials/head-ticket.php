<div class="tickethero-container">
  <div class="tickethero-banner">
    <div class="tickethero-text">
      <?php 
        if (isset($_SESSION['resident'])) {
          echo "<h3>Welcome " . $_SESSION['resident']['FirstName'] ."!</h3>";
        } else {
          echo "<h4> Login or Sign-up to submit a ticket! </h4>";
        }
      ?>
      <h2>Got complaint or request?</h2>
      <p>Your voice matters. Submit a request or complaint and let us take cake of the rest. </p>
      <p>Quick. Transparent. Hassle-Free.</p>
      <div class="tickethero-actions">
        <a href="<?= isset($_SESSION['resident']) ? 'submission.php' : '/brgy_tx_prot/views/login.php' ?>" class="btn btn-primary">Submit a Request</a>
        <a href="<?= isset($_SESSION['resident']) ? 'tickets.php' : '/brgy_tx_prot/views/login.php' ?>" class="btn btn-secondary">🔍 Track Status</a>
      </div>
    </div>
  </div>
</div>