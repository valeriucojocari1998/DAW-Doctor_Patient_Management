<?php
session_start();
$isLoggedIn = isset($_SESSION['user_id']);
var_dump($_SESSION); // Debugging - remove this in production
?>