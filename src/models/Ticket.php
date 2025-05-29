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


  public function getTicketsByResidentID($residentID)
  {
    $sql = "SELECT * FROM tickets WHERE requested_by = ? ORDER BY ticket_id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $residentID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  function getAllTicketsWithFullName() {
    $query = "
        SELECT 
          t.ticket_id,
          t.subject,
          t.description,
          t.issue_type,
          t.file_path,
          t.created_at,
          t.issue_address,
          t.status,
          t.priority_level,
          t.updated_at,
          CONCAT(r.FirstName, ' ', r.LastName) AS FullName
        FROM tickets t
        JOIN residents r ON t.requested_by = r.UserID
        ORDER BY t.created_at DESC
    ";

    $result = $this->conn->query($query);

    if (!$result) {
      // Log error or throw exception if needed
      error_log("Query failed: " . $this->conn->error);
      return [];
    }

    $tickets = [];

    while ($row = $result->fetch_assoc()) {
      $tickets[] = $row;
    }

    return $tickets;
  }

  function getResolvedTickets() {
    $query = "SELECT * FROM tickets WHERE status = 'resolved'";
    $result = $this->conn->query($query);

    if (!$result) {
      error_log("Query failed: " . $this->conn->error);
      return[];
    }

    $tickets = [];

    while($row = $result->fetch_assoc()) {
      $tickets[] = $row;
    }
    return $tickets;
  }
}
