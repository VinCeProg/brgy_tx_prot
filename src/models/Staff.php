<?php
class Staff
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }
  
  // || READ FUNCTIONS
  public function getStaffByStaffID($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM staff_accounts WHERE staff_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
