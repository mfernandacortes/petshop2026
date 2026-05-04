<?php
require_once __DIR__ . '/../../config/config.php';

class AuthController {

    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
    }

    public function loginForm() {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    public function login() {
        $username = $_POST['username'];
        $password = $_POST['password'];

        $stmt = $this->conn->prepare("SELECT * FROM admin_users WHERE username = :username LIMIT 1");
        $stmt->execute([':username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$user || !password_verify($password, $user['password'])) {
            $error = "Usuario o contraseña incorrectos.";
            require_once __DIR__ . '/../views/auth/login.php';
            return;
        }

        $_SESSION['admin_id']   = $user['id'];
        $_SESSION['admin_user'] = $user['username'];

        header("Location: index.php");
        exit;
    }

    public function logout() {
        unset($_SESSION['admin_id']);
        unset($_SESSION['admin_user']);
        header("Location: index.php?action=login");
        exit;
    }
}