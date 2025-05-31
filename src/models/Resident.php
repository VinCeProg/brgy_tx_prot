<?php
class Resident
{
  private $conn;

  public function __construct($dbConnection)
  {
    $this->conn = $dbConnection;
  }

  public function createResident($data)
  {
    //hash password
    $data['password'] = password_hash($data["password"], PASSWORD_BCRYPT);

    $query = "INSERT INTO `residents` (FirstName, LastName, Address, Email, PhoneNo, Password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $this->conn->prepare($query);

    $stmt->bind_param(
      "ssssss",
      $data['first_name'],
      $data['last_name'],
      $data['address'],
      $data['email'],
      $data['phone_no'],
      $data['password']
    );

    return $stmt->execute();
  }

  public function getByEmail($email)
  {
    $stmt = $this->conn->prepare("SELECT * FROM residents WHERE Email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    return $stmt->get_result()->fetch_assoc();
  }

  public function getNonStaffResidents()
  {
    $query = "SELECT r.UserID, CONCAT(r.FirstName, ' ', r.LastName) as fullname
              FROM residents r
              LEFT JOIN staff_accounts s ON r.UserID = s.resident_id
              WHERE s.resident_id IS NULL;";
    $stmt = $this->conn->prepare($query);

    if (!$stmt) {
      die("SQL Error: " . $this->conn->error);
    }

    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_all(MYSQLI_ASSOC);
  }
}
