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
    $query = "INSERT INTO tickets (subject, description, issue_type, requested_by, file_path, issue_address) VALUES (?,?,?,?,?,?);";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param(
      "sssiss",
      $data['subject'],
      $data['description'],
      $data['issue_type'],
      $data['requested_by'],
      $data['file_path'],
      $data['issue_address']
    );
    return $stmt->execute();
  }


  public function getTicketsByResidentID($residentID) {
    $sql = "SELECT * FROM tickets WHERE requested_by = ? ORDER BY ticket_id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $residentID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
}

}
