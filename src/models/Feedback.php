<?php
class Feedback
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  // ||CREATE FUNCTIONS
  public function submitFeedback($name, $rating, $comment)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO feedback (name, rating, comment) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("sis", $name, $rating, $comment);
    return $stmt->execute();
  }

  // ||READ FUNCTIONS

  public function getAllFeedback()
  {
    $query = "SELECT * FROM feedback ORDER BY created_at DESC";
    $result = $this->conn->query($query);
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  public function getAverageRating()
  {
    $query = "SELECT AVG(rating) as avg_rating FROM feedback";
    $result = $this->conn->query($query);
    $row = $result->fetch_assoc();
    return number_format(doubleval($row['avg_rating']), 2, '.', '');
  }

  public function getRatingCount()
  {
    $rating_counts = [
        5 => 0,
        4 => 0,
        3 => 0,
        2 => 0,
        1 => 0
    ];

    $query = "SELECT rating, COUNT(*) AS total
              FROM feedback
              GROUP BY rating
              ORDER BY rating DESC;";
    $result = $this->conn->query($query);
    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $rating = (int)$row['rating'];
        if (isset($rating_counts[$rating])) {
          $rating_counts[$rating] = (int)$row['total'];
        }
      }
    }

    // Return as an array of ['rating' => int, 'total' => int] for consistency
    $output = [];
    foreach ($rating_counts as $rating => $total) {
      $output[] = ['rating' => $rating, 'total' => $total];
    }
    return $output;
  }
}
