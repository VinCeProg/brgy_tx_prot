<?php
class TicketLog
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }

  public function logChange($ticket_id, $old_status, $new_status, $old_priority, $new_priority)
  {
    $query = "INSERT INTO ticket_logs (ticket_id, old_status, new_status, old_priority, new_priority, changed_at)
              VALUES (?, ?, ?, ?, ?, NOW())";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("issss", $ticket_id, $old_status, $new_status, $old_priority, $new_priority);
    return $stmt->execute();
  }

  public function getLogsByTicketID($ticket_id)
  {
    $query = "SELECT * FROM ticket_logs WHERE ticket_id = ? ORDER BY changed_at DESC";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
