<?php
session_start();
include_once '../../config/database.php';

$database = new Database();
$db = $database->getConnection();

// Fetch the patient details based on the ID from the URL
$patientId = $_GET['id']; // This should be validated and sanitized
$query = "SELECT * FROM patients WHERE id = :id";
$stmt = $db->prepare($query);
$stmt->bindParam(':id', $patientId);
$stmt->execute();
$patient = $stmt->fetch(PDO::FETCH_ASSOC);

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Handle form submission, validate inputs, and update the patient in the database
    $query = "UPDATE patients SET firstName = :firstName, lastName = :lastName, dob = :dob, gender = :gender, contactInfo = :contactInfo WHERE id = :id";
    $stmt = $db->prepare($query);
    $stmt->bindParam(':firstName', $_POST['firstName']);
    $stmt->bindParam(':lastName', $_POST['lastName']);
    $stmt->bindParam(':dob', $_POST['dob']);
    $stmt->bindParam(':gender', $_POST['gender']);
    $stmt->bindParam(':contactInfo', $_POST['contactInfo']);
    $stmt->bindParam(':id', $patientId);

    if ($stmt->execute()) {
        header("Location: /DAW-Doctor_Patient_Management/public/patients/index.php");
        exit();
    } else {
        echo "Failed to update patient.";
    }
}

include '../views/partials/header.php';
?>
<h2>Edit Patient</h2>
<form method="POST" action="">
    <label for="firstName">First Name:</label>
    <input type="text" name="firstName" id="firstName" value="<?php echo htmlspecialchars($patient['firstName']); ?>" required>
    <label for="lastName">Last Name:</label>
    <input type="text" name="lastName" id="lastName" value="<?php echo htmlspecialchars($patient['lastName']); ?>" required>
    <label for="dob">Date of Birth:</label>
    <input type="date" name="dob" id="dob" value="<?php echo htmlspecialchars($patient['dob']); ?>" required>
    <label for="gender">Gender:</label>
    <select name="gender" id="gender" required>
        <option value="Male" <?php if ($patient['gender'] == 'Male') echo 'selected'; ?>>Male</option>
        <option value="Female" <?php if ($patient['gender'] == 'Female') echo 'selected'; ?>>Female</option>
    </select>
    <label for="contactInfo">Contact Info:</label>
    <textarea name="contactInfo" id="contactInfo" required><?php echo htmlspecialchars($patient['contactInfo']); ?></textarea>
    <button type="submit">Update Patient</button>
</form>
<?php
include '../views/partials/footer.php';
?>
