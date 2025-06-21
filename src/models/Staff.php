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
    SELECT staff_id, resident_id, fullname, is_active, role_id
    FROM staff_accounts"
    );
    $stmt->execute();

    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  public function getRolePermission($role)
  {
    $stmt = $this->conn->prepare("SELECT * FROM staff_roles WHERE role_id = ?");
    $stmt->bind_param("i", $role);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function getAllRoles()
  {
    $stmt = $this->conn->prepare("SELECT role_id, role FROM staff_roles");
    $stmt->execute();
    return $stmt->get_result()->fetch_all(MYSQLI_ASSOC);
  }

  // || UPDATE FUNCTIONS
  public function updateStaff($staff_id, $newPassword = null, $is_active = null, $role_id = null)
  {
    $fields = [];
    $params = [];
    $paramTypes = "";

    if ($newPassword !== null) {
      $fields[] = "password = ?";
      $params[] = password_hash($newPassword, PASSWORD_DEFAULT);
      $paramTypes .= "s";
    }

    if ($is_active !== null) {
      $fields[] = "is_active = ?";
      $params[] = $is_active;
      $paramTypes .= "i";
    }

    if ($role_id !== null) {
      $fields[] = "role_id = ?";
      $params[] = $role_id;
      $paramTypes .= "i";
    }

    if (empty($fields)) return false;

    $query = "UPDATE staff_accounts SET " . implode(", ", $fields) . " WHERE staff_id = ?";
    $params[] = $staff_id;
    $paramTypes .= "i";

    $stmt = $this->conn->prepare($query);
    $stmt->bind_param($paramTypes, ...$params);
    return $stmt->execute();
  }
}
