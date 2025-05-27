<?php
class Ticket
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function createTicket($data)
  {
    $query = "INSERT INTO tickets (subject, description, issue_type, requested_by, file_path) VALUES (?,?,?,?,?);";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
      "sssis",
      $data['subject'],
      $data['description'],
      $data['issue_type'],
      $data['requested_by'],
      $data['file_path']
    );

    return $stmt->execute();
  }
}
