<?php
require_once __DIR__ . '/../../config/config.php';

class AdminController {

    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
    }

    public function dashboard() {
        // Totales para el resumen
        $total_pedidos   = $this->conn->query("SELECT COUNT(*) FROM orders")->fetchColumn();
        $pedidos_pending = $this->conn->query("SELECT COUNT(*) FROM orders WHERE status = 'pending'")->fetchColumn();
        $pedidos_conf    = $this->conn->query("SELECT COUNT(*) FROM orders WHERE status = 'confirmed'")->fetchColumn();
        $total_clientes  = $this->conn->query("SELECT COUNT(*) FROM customers")->fetchColumn();
        $total_productos = $this->conn->query("SELECT COUNT(*) FROM products")->fetchColumn();
        $facturado       = $this->conn->query("SELECT SUM(total) FROM orders WHERE status = 'confirmed'")->fetchColumn();

        require_once __DIR__ . '/../views/dashboard.php';
    }

    public function pedidos() {
        $sql = "SELECT o.id, o.status, o.total, o.created_at,
                       c.name AS cliente, c.email, c.phone
                FROM orders o
                JOIN customers c ON o.customer_id = c.id
                ORDER BY o.created_at DESC";
        $pedidos = $this->conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/pedidos/index.php';
    }

    public function detalle() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: admin/index.php?action=pedidos");
            exit;
        }

        // Datos del pedido y cliente
        $sql = "SELECT o.*, c.name AS cliente, c.email, c.phone, c.address
                FROM orders o
                JOIN customers c ON o.customer_id = c.id
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        // Items del pedido
        $sql = "SELECT oi.*, p.name AS producto, p.image
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/pedidos/detalle.php';
    }
}