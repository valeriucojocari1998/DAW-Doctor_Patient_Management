<?php
session_start();
error_reporting(E_ALL);
ini_set('display_errors', 1);

include_once '../../config/database.php';

// Initialize the database connection
$database = new Database();
$db = $database->getConnection();

include '../views/partials/header.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstName = $_POST['firstName'];
    $lastName = $_POST['lastName'];
    $dob = $_POST['dob'];
    $gender = $_POST['gender'];
    $contactInfo = $_POST['contactInfo'];
    $doctorId = $_SESSION['user_id']; // Ensure this session variable is set

    // Insert into the database
    try {
        $query = "INSERT INTO patients (firstName, lastName, dob, gender, contactInfo, doctorId) 
                  VALUES (:firstName, :lastName, :dob, :gender, :contactInfo, :doctorId)";
        $stmt = $db->prepare($query);

        // Bind parameters
        $stmt->bindParam(':firstName', $firstName);
        $stmt->bindParam(':lastName', $lastName);
        $stmt->bindParam(':dob', $dob);
        $stmt->bindParam(':gender', $gender);
        $stmt->bindParam(':contactInfo', $contactInfo);
        $stmt->bindParam(':doctorId', $doctorId);

        if ($stmt->execute()) {
            echo "<p>Patient added successfully!</p>";
        } else {
            echo "<p>Failed to add patient. Please try again.</p>";
        }
    } catch (PDOException $e) {
        echo "Error: " . $e->getMessage();
    }
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
include '../views/partials/footer.php';
?>
