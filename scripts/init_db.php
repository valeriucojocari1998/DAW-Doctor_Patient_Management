<?php
include_once '../config/database.php';

$database = new Database();
$db = $database->getConnection();

// SQL to create tables
$query = "
CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    name VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    role ENUM('doctor') NOT NULL
);

CREATE TABLE IF NOT EXISTS patients (
    id INT AUTO_INCREMENT PRIMARY KEY,
    firstName VARCHAR(255) NOT NULL,
    lastName VARCHAR(255) NOT NULL,
    dob DATE NOT NULL,
    gender ENUM('male', 'female') NOT NULL,
    contactInfo TEXT,
    doctorId INT NOT NULL,
    FOREIGN KEY (doctorId) REFERENCES users(id)
);
";

// Execute the table creation query
$stmt = $db->prepare($query);
if ($stmt->execute()) {
    echo "Tables created successfully!<br>";

    $stmt->closeCursor();

    // Insert a sample user
    $username = 'valeriucoj';
    $password = password_hash('password', PASSWORD_BCRYPT);
    $name = 'Dr. Valeriu';
    $email = 'dr.smith@example.com';
    $role = 'doctor';

    $insert_query = "INSERT INTO users (username, password, name, email, role) VALUES (:username, :password, :name, :email, :role)";
    $insert_stmt = $db->prepare($insert_query);

    // Bind parameters and execute the query
    $insert_stmt->bindParam(':username', $username);
    $insert_stmt->bindParam(':password', $password);
    $insert_stmt->bindParam(':name', $name);
    $insert_stmt->bindParam(':email', $email);
    $insert_stmt->bindParam(':role', $role);

    if ($insert_stmt->execute()) {
        echo "Sample user inserted successfully!";
    } else {
        echo "Failed to insert sample user.";
    }
} else {
    echo "Failed to create tables.";
}
?>
