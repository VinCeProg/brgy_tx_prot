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
$selectedRating = isset($_GET['filter_rating']) ? (int)$_GET['filter_rating'] : 0;
$search = trim($_GET['search'] ?? '');
$from = $_GET['from'] ?? '';
$to = $_GET['to'] ?? '';
$sort = $_GET['sort'] ?? 'date_desc';

$feedbacks = $feedbackModel->getFilteredFeedback([
  'rating' => $selectedRating,
  'search' => $search,
  'from' => $from,
  'to' => $to,
  'sort' => $sort
]);
$recentFeedbacks = $feedbackModel->getRecentFeedbacks(5);
$aveRating = $feedbackModel->getAverageRating();
$ratingCount = $feedbackModel->getRatingCount();

$totalRatings = array_sum(array_column($ratingCount, 'total'));
foreach ($ratingCount as &$entry) {
  $entry['percentage'] = $totalRatings ? ($entry['total'] / $totalRatings) * 100 : 0;
}

?>
<link rel="stylesheet" href="/brgy_tx_prot/public/css/admin.feedback.css">
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<body style="padding: 4px;">
  <?php require("partials/navbar.php"); ?>
  <div class="feedback-cards-wrapper">
    <div class="recent-feedbacks">
      <h3>Recent Feedback</h3>
      <?php foreach ($recentFeedbacks as $fb): ?>
        <div class="feedback-card">
          <div class="card-header">
            <span class="name"><?= htmlspecialchars($fb['name']) ?: 'Anonymous' ?></span>
            <span class="date"><?= date("M d, Y", strtotime($fb['created_at'])) ?></span>
          </div>
          <div class="card-rating">
            <?php
            $stars = (int)$fb['rating'];
            echo str_repeat('★', $stars) . str_repeat('☆', 5 - $stars);
            ?>
          </div>
          <div class="card-comment">
            <?= nl2br(htmlspecialchars($fb['comment'])) ?>
          </div>
        </div>
      <?php endforeach; ?>
    </div>

    <div class="feedback-summary">
      <h3>Total Average Rating</h3>
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

    <div class="feedback-controls">
      <h3>Filter/Search</h3>
      <form method="GET" class="filters-group">
        <div class="form-row">
          <div class="form-group">
            <label for="filter_rating">Filter by Rating</label>
            <select name="filter_rating" id="filter_rating">
              <option value="0">Show All</option>
              <?php for ($r = 5; $r >= 1; $r--): ?>
                <option value="<?= $r ?>" <?= ($selectedRating === $r) ? 'selected' : '' ?>>
                  <?= $r ?> Star<?= $r > 1 ? 's' : '' ?>
                </option>
              <?php endfor; ?>
            </select>
          </div>

          <div class="form-group">
            <label for="search">Search</label>
            <input type="text" name="search" id="search" placeholder="Name or comment..." value="<?= htmlspecialchars($_GET['search'] ?? '') ?>">
          </div>

          <div class="form-group">
            <label for="from">From</label>
            <input type="date" name="from" id="from" value="<?= $_GET['from'] ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="to">To</label>
            <input type="date" name="to" id="to" value="<?= $_GET['to'] ?? '' ?>">
          </div>

          <div class="form-group">
            <label for="sort">Sort By</label>
            <select name="sort" id="sort">
              <option value="date_desc" <?= ($_GET['sort'] ?? '') === 'date_desc' ? 'selected' : '' ?>>Newest First</option>
              <option value="date_asc" <?= ($_GET['sort'] ?? '') === 'date_asc' ? 'selected' : '' ?>>Oldest First</option>
              <option value="rating_desc" <?= ($_GET['sort'] ?? '') === 'rating_desc' ? 'selected' : '' ?>>Highest Rating</option>
              <option value="rating_asc" <?= ($_GET['sort'] ?? '') === 'rating_asc' ? 'selected' : '' ?>>Lowest Rating</option>
            </select>
          </div>

          <div class="form-group full-width">
            <button type="submit" class="btn btn-primary">Apply Filters</button>
          </div>
        </div>
      </form>

      <form method="POST" action="export_feedback.php" class="export-form">
        <button type="submit" class="btn btn-secondary">Export to Excel</button>
      </form>
    </div>

  </div>

  <div class="feedback-results">
    <table id="feedback-table">
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
  </div>
  
  <script>
    function getTimestampedFilename(baseName, extension) {
      const now = new Date();
      const dateStr = now.toISOString().replace(/T/, '_').replace(/:/g, '-').replace(/\..+/, '');
      return `${baseName}_${dateStr}.${extension}`;
    }

    document.querySelector('.export-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const table = document.getElementById("feedback-table");
      const wb = XLSX.utils.table_to_book(table, {
        sheet: "Feedback"
      });
      const filename = getTimestampedFilename("feedback_report", "xlsx");
      XLSX.writeFile(wb, filename);
    });
  </script>
</body>

</html>