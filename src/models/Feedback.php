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

  public function getFeedbackByRating(int $rating)
  {
    $stmt = $this->conn->prepare("SELECT * FROM feedback WHERE rating = ? ORDER BY created_at DESC");
    $stmt->bind_param("i", $rating);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
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

  public function getRecentFeedbacks($limit = 5)
  {
    $stmt = $this->conn->prepare("SELECT * FROM feedback ORDER BY created_at DESC LIMIT ?");
    $stmt->bind_param("i", $limit);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function getFilteredFeedback($filters = [])
  {
    $sql = "SELECT * FROM feedback WHERE 1";
    $params = [];
    $types = "";

    // Filter by rating
    if (!empty($filters['rating']) && $filters['rating'] > 0) {
      $sql .= " AND rating = ?";
      $params[] = $filters['rating'];
      $types .= "i";
    }

    // Search by name or comment
    if (!empty($filters['search'])) {
      $sql .= " AND (name LIKE ? OR comment LIKE ?)";
      $searchTerm = '%' . $filters['search'] . '%';
      $params[] = $searchTerm;
      $params[] = $searchTerm;
      $types .= "ss";
    }

    // Filter by date range
    if (!empty($filters['from'])) {
      $sql .= " AND DATE(created_at) >= ?";
      $params[] = $filters['from'];
      $types .= "s";
    }
    if (!empty($filters['to'])) {
      $sql .= " AND DATE(created_at) <= ?";
      $params[] = $filters['to'];
      $types .= "s";
    }

    // Sorting
    switch ($filters['sort'] ?? '') {
      case 'date_asc':
        $sql .= " ORDER BY created_at ASC";
        break;
      case 'rating_desc':
        $sql .= " ORDER BY rating DESC, created_at DESC";
        break;
      case 'rating_asc':
        $sql .= " ORDER BY rating ASC, created_at DESC";
        break;
      case 'date_desc':
      default:
        $sql .= " ORDER BY created_at DESC";
        break;
    }

    $stmt = $this->conn->prepare($sql);
    if (!empty($params)) {
      $stmt->bind_param($types, ...$params);
    }
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
