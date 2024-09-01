<?php
include_once '../config/database.php';
include_once '../models/Patient.php';

class PatientController {
    private $db;
    private $patient;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->patient = new Patient($this->db);
    }

    public function index($doctorId) {
        $stmt = $this->patient->readAllByDoctor($doctorId);
        $patients = $stmt->fetchAll(PDO::FETCH_ASSOC);
        include '../views/patients/index.php';
    }

    public function create($doctorId) {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->patient->firstName = $_POST['firstName'];
            $this->patient->lastName = $_POST['lastName'];
            $this->patient->dob = $_POST['dob'];
            $this->patient->gender = $_POST['gender'];
            $this->patient->contactInfo = $_POST['contactInfo'];
            $this->patient->doctorId = $doctorId;

            if($this->patient->create()) {
                header("Location: /patients/index.php");
            } else {
                echo "Patient creation failed!";
            }
        }
        include '../views/patients/create.php';
    }

    public function edit($id, $doctorId) {
        $this->patient->id = $id;
        $this->patient->doctorId = $doctorId;

        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->patient->firstName = $_POST['firstName'];
            $this->patient->lastName = $_POST['lastName'];
            $this->patient->dob = $_POST['dob'];
            $this->patient->gender = $_POST['gender'];
            $this->patient->contactInfo = $_POST['contactInfo'];

            if($this->patient->update()) {
                header("Location: /patients/index.php");
            } else {
                echo "Patient update failed!";
            }
        } else {
            $this->patient->readOne();
            include '../views/patients/edit.php';
        }
    }

    public function delete($id, $doctorId) {
        $this->patient->id = $id;
        $this->patient->doctorId = $doctorId;

        if($this->patient->delete()) {
            header("Location: /patients/index.php");
        } else {
            echo "Patient deletion failed!";
        }
    }
}
?>
