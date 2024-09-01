<?php
include_once '../config/database.php';
include_once '../models/User.php';

class AuthController {
    private $db;
    private $user;

    public function __construct() {
        $database = new Database();
        $this->db = $database->getConnection();
        $this->user = new User($this->db);
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $this->user->username = $_POST['username'];
            $this->user->password = $_POST['password'];

            if($this->user->login()) {
                session_start();
                $_SESSION['user_id'] = $this->user->id;
                $_SESSION['role'] = $this->user->role;
                header("Location: /patients/index.php");
            } else {
                echo "Login failed!";
            }
        }
    }

    public function logout() {
        session_start();
        session_destroy();
        header("Location: /auth/login.php");
    }
}
?>
