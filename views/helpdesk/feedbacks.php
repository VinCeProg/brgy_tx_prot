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
?>

<body style="padding: 4px;">
  <?php require("partials/navbar.php"); ?>
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

<!-- SheetJS for Excel -->
<script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>

<!-- html2pdf for PDF -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.10.1/html2pdf.bundle.min.js"></script>

</html>