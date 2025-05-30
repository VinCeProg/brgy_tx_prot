<?php
class Ticket
{
  private $conn;

  public function __construct($db)
  {
    $this->conn = $db;
  }


  // || CREATE
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


  // || READ
  public function getTicketsByResidentID($residentID)
  {
    $sql = "SELECT * FROM tickets WHERE requested_by = ? ORDER BY ticket_id DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->bind_param("i", $residentID);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }

  function getAllTicketsWithFullName()
  {
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

  function getTicketByTicketID($ticketID)
  {
    $query = "SELECT 
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
          CONCAT(r.FirstName, ' ', r.LastName) AS FullName,
          r.Email,
          r.PhoneNo
        FROM tickets t
        JOIN residents r ON t.requested_by = r.UserID
        WHERE t.ticket_id = ?
        ORDER BY t.created_at DESC";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("i", $ticketID);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows > 0) {
      return $result->fetch_assoc();
    } else {
      return null;
    }
  }

  function getResolvedTickets()
  {
    $query = "SELECT * FROM tickets WHERE status = 'resolved'";
    $result = $this->conn->query($query);

    if (!$result) {
      error_log("Query failed: " . $this->conn->error);
      return [];
    }

    $tickets = [];

    while ($row = $result->fetch_assoc()) {
      $tickets[] = $row;
    }
    return $tickets;
  }

  function getTicketStatusCount()
  {
    $query = "SELECT status FROM tickets";
    $result = $this->conn->query($query);

    // Initialize all statuses with 0 count
    $status_counts = [
      'pending' => 0,
      'in progress' => 0,
      'resolved' => 0
    ];

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $status = strtolower($row['status']); // Normalize casing
        if (array_key_exists($status, $status_counts)) {
          $status_counts[$status]++;
        }
      }
    } else {
      error_log("No Ticket Found or Query Error: " . $this->conn->error);
    }

    return $status_counts;
  }


  function getTicketPriorityCount()
  {
    $query = "SELECT priority_level FROM tickets";
    $result = $this->conn->query($query);

    $priority_counts = [
      "Low" => 0,
      "Medium" => 0,
      "High" => 0,
      "Urgent" => 0
    ];

    if ($result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $priority = $row['priority_level'];
        if (isset($priority_counts[$priority])) {
          $priority_counts[$priority]++;
        }
      }
    } else {
      error_log("No Ticket Found: " . $this->conn->error);
    }

    return $priority_counts;
  }

  function getTicketCountsPerDay()
  {
    $query = "SELECT DATE(created_at) as date, COUNT(*) as count 
              FROM tickets 
              WHERE created_at >= CURDATE() - INTERVAL 6 DAY
              GROUP BY DATE(created_at) 
              ORDER BY DATE(created_at)";

    $result = $this->conn->query($query);

    $dates = [];
    $counts = [];

    if ($result && $result->num_rows > 0) {
      while ($row = $result->fetch_assoc()) {
        $dates[] = $row['date'];
        $counts[] = $row['count'];
      }
    }

    return [
      'dates' => $dates,
      'counts' => $counts
    ];
  }



  // || UPDATE
  public function updateTicket($id, $status, $priority)
  {
    $query = "UPDATE tickets SET status = ?, priority_level = ?, updated_at = NOW() WHERE ticket_id = ?";
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param("ssi", $status, $priority, $id);
    return $stmt->execute();
  }
}
