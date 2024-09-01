<?php
session_start();

if (isset($_SESSION['user_id'])) {
    header("Location: /DAW-Doctor_Patient_Management/public/patients/index.php");
} else {
    header("Location: /DAW-Doctor_Patient_Management/public/views/auth/login.php");
}
exit();
