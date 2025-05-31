<?php
class Staff
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  // || CREATE FUNCTIONS
  public function createStaffAccount($resident_id, $password)
  {
    $hashedPassword = password_hash($password, PASSWORD_BCRYPT);

    $stmt = $this->conn->prepare(
        "INSERT INTO staff_accounts (resident_id, fullname, password)
         SELECT r.UserID, CONCAT(r.FirstName, ' ', r.LastName), ? 
         FROM residents r
         WHERE r.UserID = ?"
    );

    if(!$stmt) {
      die("SQL Error: " . $this->conn->error);
    }

    $stmt->bind_param("si", $hashedPassword, $resident_id);

    return $stmt->execute();
  }

  // || READ FUNCTIONS
  public function getStaffByID($id)
  {
    $stmt = $this->conn->prepare("SELECT * FROM staff_accounts WHERE staff_id = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }
}
