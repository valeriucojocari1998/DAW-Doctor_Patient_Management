<?php
class Patient {
    private $conn;
    private $table_name = "patients";

    public $id;
    public $firstName;
    public $lastName;
    public $dob;
    public $gender;
    public $contactInfo;
    public $doctorId;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET firstName=:firstName, lastName=:lastName, dob=:dob, gender=:gender, contactInfo=:contactInfo, doctorId=:doctorId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":contactInfo", $this->contactInfo);
        $stmt->bindParam(":doctorId", $this->doctorId);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function readAllByDoctor($doctorId) {
        $query = "SELECT * FROM " . $this->table_name . " WHERE doctorId = :doctorId";
        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(":doctorId", $doctorId);
        $stmt->execute();

        return $stmt;
    }

    public function readOne() {
        $query = "SELECT * FROM " . $this->table_name . " WHERE id = ? AND doctorId = ? LIMIT 0,1";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->doctorId);
        $stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        $this->firstName = $row['firstName'];
        $this->lastName = $row['lastName'];
        $this->dob = $row['dob'];
        $this->gender = $row['gender'];
        $this->contactInfo = $row['contactInfo'];
    }

    public function update() {
        $query = "UPDATE " . $this->table_name . " SET firstName = :firstName, lastName = :lastName, dob = :dob, gender = :gender, contactInfo = :contactInfo WHERE id = :id AND doctorId = :doctorId";

        $stmt = $this->conn->prepare($query);

        $stmt->bindParam(":firstName", $this->firstName);
        $stmt->bindParam(":lastName", $this->lastName);
        $stmt->bindParam(":dob", $this->dob);
        $stmt->bindParam(":gender", $this->gender);
        $stmt->bindParam(":contactInfo", $this->contactInfo);
        $stmt->bindParam(":doctorId", $this->doctorId);
        $stmt->bindParam(":id", $this->id);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }

    public function delete() {
        $query = "DELETE FROM " . $this->table_name . " WHERE id = ? AND doctorId = ?";

        $stmt = $this->conn->prepare($query);
        $stmt->bindParam(1, $this->id);
        $stmt->bindParam(2, $this->doctorId);

        if($stmt->execute()) {
            return true;
        }
        return false;
    }
}
?>
