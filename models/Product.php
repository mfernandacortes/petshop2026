<?php
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/../core/Database.php';

class Product {

    private $conn;

    public function __construct() {
        $this->conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);

        if ($this->conn->connect_error) {
            die("Error conexión: " . $this->conn->connect_error);
        }

        $this->conn->set_charset("utf8");
    }

    public function getAll() {
        $sql = "SELECT * FROM products WHERE active = 1";
        $result = $this->conn->query($sql);

        $products = [];
        while ($row = $result->fetch_assoc()) {
            $products[] = $row;
        }

        return $products;
    }

    public function getById($id) {
        $sql = "SELECT * FROM products WHERE id = $id";
        $result = $this->conn->query($sql);

        return $result->fetch_assoc();
    }
}




