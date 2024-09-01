<?php
session_start();
include_once '../../config/database.php'; // Correct path to database.php
include '../views/partials/header.php'; // Correct path to header.php

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission, validate inputs, and save the patient to the database
    // Redirect to the patients list page after successful creation
}

?>
<h2>Add New Patient</h2>
<form method="POST" action="">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" id="firstName" required>
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" id="lastName" required>
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" required>
    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="Male">Male</option>
        <option value="Female">Female</option>
    </select>
    <label for="contactInfo">Contact Info:</label>
    <textarea name="contactInfo" id="contactInfo" required></textarea>
    <button type="submit">Add Patient</button>
</form>
<?php
include '../views/partials/footer.php'; // Correct path to footer.php
?>
