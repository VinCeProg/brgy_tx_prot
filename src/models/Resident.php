<?php
class Resident {
  private $conn;

  public function __construct($dbConnection) {
    $this->conn = $dbConnection;
  }

  public function createResident($data) {
    //hash password
    $data['password'] = password_hash($data["password"], PASSWORD_BCRYPT);

    $query = "INSERT INTO `residents` (FirstName, LastName, Address, Email, PhoneNo, Password) VALUES (?, ?, ?, ?, ?, ?);";
    $stmt = $this->conn->prepare($query);

    $stmt->bind_param("ssssss", 
                      $data['first_name'],
                      $data['last_name'],
                      $data['address'],
                      $data['email'],
                      $data['phone_no'],
                      $data['password']
    );

    return $stmt->execute();
  }
}

?>