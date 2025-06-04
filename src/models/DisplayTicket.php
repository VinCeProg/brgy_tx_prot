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

  public function getAllDisplayTickets() {
    $sql = "SELECT * FROM display_tickets";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function getAllVisibleDisplayTickets() {
    $sql = "SELECT * FROM display_tickets WHERE is_visible = 1";
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

}
