<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$isLoggedIn = isset($_SESSION['user_id']);
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Doctor Patient Management</title>
    <link rel="stylesheet" href="/DAW-Doctor_Patient_Management/public/assets/css/style.css">
</head>

<body>
    <header>
        <h1>Doctor Patient Management System</h1>
        <nav>
            <ul>
                <li><a href="/DAW-Doctor_Patient_Management/public/home/index.php">Home</a></li>
                <?php if ($isLoggedIn): ?>
                    <li><a href="/DAW-Doctor_Patient_Management/public/patients/index.php">Patients</a></li>
                    <li><a href="/DAW-Doctor_Patient_Management/public/views/auth/logout.php">Logout</a></li>
                <?php else: ?>
                    <li><a href="/DAW-Doctor_Patient_Management/public/views/auth/login.php">Login</a></li>
                <?php endif; ?>
            </ul>
        </nav>
    </header>
    <main>