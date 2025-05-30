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

// || Staff's Messages
class StaffMessage
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  public function getMessageByTicket($ticket_id)
  {
    $query = "SELECT sm.*, s.fullname 
              FROM staff_ticket_messages sm
              JOIN staff_accounts s ON sm.staff_id = s.staff_id 
              WHERE ticket_id = ? ORDER BY created_at ASC;";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function sendMessage($ticket_id, $staff_id, $message)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO staff_ticket_messages (ticket_id, staff_id, message) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iis", $ticket_id, $staff_id, $message);
    return $stmt->execute();
  }
}


// || Resident's Messages
class ResidentMessage
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  public function getMessageByTicket($ticket_id)
  { $query = "SELECT rm.*, CONCAT(r.FirstName, ' ', r.LastName)
              FROM resident_ticket_messages rm
              JOIN residents r ON rm.resident_id = r.UserID
              WHERE ticket_id = ? ORDER BY created_at ASC";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $ticket_id);
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function addMessage($ticket_id, $resident_id, $message)
  {
    $stmt = $this->conn->prepare(
      "INSERT INTO resident_ticket_messages (ticket_id, resident_id, message) VALUES (?, ?, ?)"
    );
    $stmt->bind_param("iis", $ticket_id, $resident_id, $message);
    return $stmt->execute();
  }
}
