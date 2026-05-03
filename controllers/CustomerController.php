<?php
require_once __DIR__ . '/../config/config.php';

class CustomerController {

    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
    }

    public function loginForm() {
        require_once __DIR__ . '/../views/customers/login.php';
    }

    public function registroForm() {
        require_once __DIR__ . '/../views/customers/registro.php';
    }

    public function login() {
        $email    = $_POST['email'];
        $password = $_POST['password'];

        $sql  = "SELECT * FROM customers WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);
        $customer = $stmt->fetch(PDO::FETCH_ASSOC);

        if (!$customer || !password_verify($password, $customer['password'])) {
            $error = "Email o contraseña incorrectos.";
            require_once __DIR__ . '/../views/customers/login.php';
            return;
        }

        $_SESSION['customer_id']   = $customer['id'];
        $_SESSION['customer_name'] = $customer['name'];

        header("Location: index.php");
        exit;
    }

    public function registro() {
        $name     = $_POST['name'];
        $email    = $_POST['email'];
        $phone    = $_POST['phone'];
        $address  = $_POST['address'];
        $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

        // Verificar si el email ya existe
        $sql  = "SELECT id FROM customers WHERE email = :email LIMIT 1";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':email' => $email]);

        if ($stmt->fetch()) {
            $error = "Ese email ya está registrado.";
            require_once __DIR__ . '/../views/customers/registro.php';
            return;
        }

        $sql  = "INSERT INTO customers (name, email, phone, address, password) 
                 VALUES (:name, :email, :phone, :address, :password)";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':name'     => $name,
            ':email'    => $email,
            ':phone'    => $phone,
            ':address'  => $address,
            ':password' => $password
        ]);

        $_SESSION['customer_id']   = $this->conn->lastInsertId();
        $_SESSION['customer_name'] = $name;

        header("Location: index.php");
        exit;
    }

    public function logout() {
        unset($_SESSION['customer_id']);
        unset($_SESSION['customer_name']);
        unset($_SESSION['order_id']);

        header("Location: index.php?action=login");
        exit;
    }
}