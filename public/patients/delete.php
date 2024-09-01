<?php
session_start();
include_once '../../config/database.php';

// Check if an ID was provided in the URL
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $patientId = $_GET['id'];

    // Initialize the database connection
    $database = new Database();
    $db = $database->getConnection();

    // Prepare the delete query
    $query = "DELETE FROM patients WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':id', $patientId);

    // Execute the query
    if ($stmt->execute()) {
        // Redirect back to the patient list with a success message
        header("Location: /DAW-Doctor_Patient_Management/public/patients/index.php?message=Patient+deleted+successfully");
        exit();
    } else {
        // Redirect back with an error message if the delete fails
        header("Location: /DAW-Doctor_Patient_Management/public/patients/index.php?error=Failed+to+delete+patient");
        exit();
    }
} else {
    // If no ID is provided in the URL, redirect back with an error message
    header("Location: /DAW-Doctor_Patient_Management/public/patients/index.php?error=No+patient+ID+provided");
    exit();
}
