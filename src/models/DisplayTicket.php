<?php
class DisplayTicket
{
  private $conn;

  public function __construct($conn)
  {
    $this->conn = $conn;
  }

  // || CREATE FUNCTIONS
  public function uploadDisplayTicket($ticketId, $subject, $description, $filePath)
  {
    $sql = "INSERT INTO display_tickets (ticket_id, subject, description, file_path) VALUES (?, ?, ?, ?)";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("isss", $ticketId, $subject, $description, $filePath);
    return $stmt->execute();
  }

  // || READ FUNCTIONS

  public function getAllDisplayTickets()
  {
    $sql = "SELECT * FROM display_tickets";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function getAllVisibleDisplayTickets()
  {
    $sql = "SELECT * FROM display_tickets WHERE is_visible = 1 ORDER BY display_id DESC;";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function getResolvedTicketsWithNoDisplay()
  {
    $sql = "
            SELECT t.ticket_id, t.subject
            FROM tickets t
            WHERE t.status = 'Resolved'
              AND NOT EXISTS (
                SELECT 1 FROM display_tickets d WHERE d.ticket_id = t.ticket_id
              )
        ";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  // || UPDATE FUNCTIONS
  public function updateDisplayTicket($displayId, $data)
  {
    $query = "UPDATE display_tickets 
              SET subject = ?, description = ?, is_visible = ?";

    $params = [
      $data['subject'],
      $data['description'],
      $data['is_visible']
    ];

    // Optional file_path update if a new image is provided
    if (!empty($data['file_path'])) {
      $query .= ", file_path = ?";
      $params[] = $data['file_path'];
    }

    $query .= " WHERE display_id = ?";
    $params[] = $displayId;

    $stmt = $this->conn->prepare($query);

    // Dynamic types string (all strings except is_visible is int)
    $types = str_repeat("s", count($params) - 1) . "i";

    $stmt->bind_param($types, ...$params);

    return $stmt->execute();
  }
}
