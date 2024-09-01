<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

$insert_doctor_query = "
INSERT INTO users (username, password, name, email, role) VALUES 
('doctor1', :password, 'Dr. John Doe', 'doctor1@example.com', 'doctor')
";
$password = password_hash('password', PASSWORD_BCRYPT);
$stmt = $db->prepare($insert_doctor_query);
$stmt->bindParam(':password', $password);

if ($stmt->execute()) {
    $doctorId = $db->lastInsertId(); // Get the ID of the newly inserted doctor
    echo "Doctor inserted successfully with ID: $doctorId";
} else {
    echo "Failed to insert doctor.";
    exit();
}

$insert_patients_query = "
INSERT INTO patients (firstName, lastName, dob, gender, contactInfo, doctorId) VALUES 
('John', 'Doe', '1985-06-15', 'Male', 'Contact info for John Doe', :doctorId),
('Jane', 'Smith', '1990-04-10', 'Female', 'Contact info for Jane Smith', :doctorId),
('Alice', 'Johnson', '1992-02-25', 'Female', 'Contact info for Alice Johnson', :doctorId),
('Bob', 'Brown', '1988-07-17', 'Male', 'Contact info for Bob Brown', :doctorId)
";
$stmt = $db->prepare($insert_patients_query);
$stmt->bindParam(':doctorId', $doctorId);

if ($stmt->execute()) {
    echo "Sample patients inserted successfully!";
} else {
    echo "Failed to insert sample patients.";
}
?>