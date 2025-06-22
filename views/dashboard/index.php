<?php
$pagetitle = 'Dashboard';
require("../../config/auth.php");
require("../../functions.php");
require("../partials/html.head.php");
// dd($_SERVER);
?>

<body>
  <?php require("../partials/newnav.php") ?>
  <main>
    
    <?php 
      require("../partials/head-ticket.php");
      require("partials/ticket-table-resolved.php");
      require("../partials/headline.php");
      require("../partials/brgy-transparency.php");
      require("../partials/mission-vision.php");
    ?>

  </main>
  <a href="/brgy_tx_prot/views/feedback-survey.php" class="floating-feedback-btn"></a>
  <?php require("../partials/footer.php") ?>
</body>

</html>