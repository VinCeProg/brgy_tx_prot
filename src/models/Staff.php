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

    if (!$stmt) {
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

  public function getAllStaff()
  {
    $stmt = $this->conn->prepare(
      "
    SELECT staff_id, resident_id, fullname, is_active, is_admin
    FROM staff_accounts"
    );
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  // || UPDATE FUNCTIONS
  public function updateStaff($staff_id, $newPassword = null, $is_admin = null, $is_active = null)
  {
    $fields = [];
    $params = [];
    $paramTypes = "";

    // If password is provided, hash it
    if ($newPassword !== null) {
      $fields[] = "password = ?";
      $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
      $paramTypes .= "s";
    }

    // If is_admin is provided
    if ($is_admin !== null) {
      $fields[] = "is_admin = ?";
      $params[] = $is_admin;
      $paramTypes .= "i";
    }

    // If is_active is provided
    if ($is_active !== null) {
      $fields[] = "is_active = ?";
      $params[] = $is_active;
      $paramTypes .= "i";
    }

    // Ensure at least one field is being updated
    if (empty($fields)) {
      return false;
    }

    // Build the dynamic SQL query
    $query = "UPDATE staff_accounts SET " . implode(", ", $fields) . " WHERE staff_id = ?";
    $params[] = $staff_id;
    $paramTypes .= "i";

    // Prepare and execute the query
    $stmt = $this->conn->prepare($query);
    $stmt->bind_param($paramTypes, ...$params);

    return $stmt->execute();
  }
}
