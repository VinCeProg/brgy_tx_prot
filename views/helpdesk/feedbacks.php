<?php
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

$pagetitle = 'Feedbacks';
require("../../config/staff-auth.php"); //for login auth
if (!$_SESSION['staff_permissions']['manage_content']) {
  http_response_code(403);
  exit("Forbidden");
}
require("../../functions.php");
require("partials/html.head.php");
require __DIR__ . "/../../config/database.php";
require __DIR__ . "/../../src/models/Feedback.php";

$feedbackModel = new Feedback($conn);
$feedbacks = $feedbackModel->getAllFeedback();
$aveRating = $feedbackModel->getAverageRating();
$ratingCount = $feedbackModel->getRatingCount();

$totalRatings = array_sum(array_column($ratingCount, 'total'));
foreach ($ratingCount as &$entry) {
  $entry['percentage'] = $totalRatings ? ($entry['total'] / $totalRatings) * 100 : 0;
}

?>
<link rel="stylesheet" href="/brgy_tx_prot/public/css/admin.feedback.css">

<body style="padding: 4px;">
  <?php require("partials/navbar.php"); ?>
  <div class="feedback-summary">
    <div class="average-rating">
      <strong>Average Rating:</strong>
      <span class="stars">
        <?php
        $fullStars = floor($aveRating);
        $halfStar = ($aveRating - $fullStars >= 0.5);
        for ($i = 1; $i <= 5; $i++) {
          if ($i <= $fullStars) echo '★';
          elseif ($halfStar && $i === $fullStars + 1) echo '⯪';
          else echo '☆';
        }
        ?>
        <span class="numeric">(<?= number_format($aveRating, 2) ?>)</span>
      </span>
    </div>

    <div class="rating-counts">
      <?php foreach (array_reverse($ratingCount) as $entry): ?>
        <?php
        $tooltipText = match ($entry['rating']) {
          5 => 'Excellent',
          4 => 'Good',
          3 => 'Average',
          2 => 'Poor',
          1 => 'Very Poor',
          default => ''
        };
        ?>
        <div class="rating-bar">
          <div class="stars-label" data-tooltip="<?= $tooltipText ?>">
            <?= str_repeat('★', $entry['rating']) ?>
          </div>
          <div class="bar-container">
            <div class="bar-fill" style="width: <?= $entry['percentage'] ?? 0 ?>%;"></div>
          </div>
          <div class="count"><?= $entry['total'] ?></div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>



  <table>
    <thead>
      <th>Feedback ID</th>
      <th>Name</th>
      <th>Rating</th>
      <th>Comment</th>
      <th>Created At</th>
    </thead>
    <tbody>
      <?php foreach ($feedbacks as $feedback): ?>
        <tr>
          <td><?= htmlspecialchars($feedback['id']) ?></td>
          <td><?= htmlspecialchars($feedback['name']) ?></td>
          <td><?= htmlspecialchars($feedback['rating']) ?></td>
          <td><?= htmlspecialchars($feedback['comment']) ?></td>
          <td><?= htmlspecialchars($feedback['created_at']) ?></td>
        </tr>
      <?php endforeach; ?>
    </tbody>
  </table>
</body>

</html>