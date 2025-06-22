<?php
class Feedback
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  public function getAllFeedback()
  {
    $query = "SELECT * FROM feedback ORDER BY created_at DESC";
    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function submitFeedback($name, $rating, $comment)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO feedback (name, rating, comment) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sis", $name, $rating, $comment);
    return $stmt->execute();
  }
}
