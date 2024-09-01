<?php
session_start();
include_once '../../config/database.php';

// Redirect to login page if the user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /DAW-Doctor_Patient_Management/public/views/auth/login.php");
    exit();
}

$database = new Database();
$db = $database->getConnection();

// Fetch patients from the database
$query = "SELECT * FROM patients";
$stmt = $db->prepare($query);
$stmt->execute();
$patients = $stmt->fetchAll(PDO::FETCH_ASSOC);

include '../views/partials/header.php';
?>
<h2>Patients</h2>
<a href="/DAW-Doctor_Patient_Management/public/patients/create.php">Add New Patient</a>
<table>
    <thead>
        <tr>
            <th>Name</th>
            <th>Date of Birth</th>
            <th>Gender</th>
            <th>Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($patients as $patient): ?>
            <tr>
                <td><?php echo htmlspecialchars($patient['firstName'] . ' ' . $patient['lastName']); ?></td>
                <td><?php echo htmlspecialchars($patient['dob']); ?></td>
                <td><?php echo htmlspecialchars($patient['gender']); ?></td>
                <td>
                    <a
                        href="/DAW-Doctor_Patient_Management/public/patients/edit.php?id=<?php echo $patient['id']; ?>">Edit</a>
                    <a href="/DAW-Doctor_Patient_Management/public/patients/delete.php?id=<?php echo $patient['id']; ?>"
                        onclick="return confirm('Are you sure?');">Delete</a>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php
include '../views/partials/footer.php';
?>