<?php
session_start();
require_once("../../config/database.php");
require_once("../../src/models/Feedback.php");

$feedback = new Feedback($conn);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
  $name = htmlspecialchars(trim($_POST['name'] ?? 'Anonymous'));
  $rating = intval($_POST['rating']);
  $comment = htmlspecialchars(trim($_POST['comment'] ?? ''));

  if ($rating >= 1 && $rating <= 5 && !empty($comment)) {
    if ($feedback->submitFeedback($name, $rating, $comment)) {
      echo "<script>alert('Thank you for your feedback!'); window.location.href = '/brgy_tx_prot/views/feedback-survey.php';</script>";
    } else {
      echo "<p style='color:red;'>Something went wrong. Please try again later.</p>";
    }
  } else {
    echo "<p style='color:red;'>Please fill out all required fields.</p>";
  }
}
