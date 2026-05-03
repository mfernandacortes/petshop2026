<?php
require_once __DIR__ . '/../config/config.php';

class OrderController {

    private $conn;

    public function __construct() {
        $this->conn = new PDO(
            "mysql:host=" . DB_HOST . ";dbname=" . DB_NAME . ";charset=utf8",
            DB_USER,
            DB_PASS
        );
    }

    // Se llama al inicio de la sesión del cliente
    public function iniciarOrden() {
    
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (isset($_SESSION['order_id'])) {
        return $_SESSION['order_id'];
    }

    $customer_id = $_SESSION['customer_id'] ?? 1;

    $sql = "INSERT INTO orders (customer_id, total, status) 
            VALUES (:customer_id, 0, 'pending')";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':customer_id' => $customer_id]);

    $order_id = $this->conn->lastInsertId();
    $_SESSION['order_id'] = $order_id;

    return $order_id;
}

    public function guardarPedido() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $product_id = $_POST['product_id'];
    $text1      = $_POST['text1'];
    $text2      = $_POST['text2'] ?? '';
    $engraving  = isset($_POST['engraving']) ? 1 : 0;

    // Tomamos el order_id de la sesión
    $order_id = $_SESSION['order_id'] ?? null;

    // Verificamos que la orden realmente existe en la BD
    if ($order_id) {
        $sql_check  = "SELECT id FROM orders WHERE id = :order_id";
        $stmt_check = $this->conn->prepare($sql_check);
        $stmt_check->execute([':order_id' => $order_id]);
        if (!$stmt_check->fetch()) {
            unset($_SESSION['order_id']);
            $order_id = null;
        }
    }

    // Si no hay orden válida, creamos una nueva
    if (!$order_id) {
        $order_id = $this->iniciarOrden();
    }

    $sql = "INSERT INTO order_items 
            (order_id, product_id, quantity, unit_price, text_line_1, text_line_2, engraving)
            VALUES (:order_id, :product_id, 1, :unit_price, :text1, :text2, :engraving)";

    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':order_id'   => $order_id,
        ':product_id' => $product_id,
        ':unit_price' => $this->getPrecioProducto($product_id),
        ':text1'      => $text1,
        ':text2'      => $text2,
        ':engraving'  => $engraving
    ]);

    echo "Producto agregado al pedido";
}

 /*   public function guardarPedido() {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $product_id = $_POST['product_id'];
        $text1      = $_POST['text1'];
        $text2      = $_POST['text2'] ?? '';
        $engraving  = isset($_POST['engraving']) ? 1 : 0;

        // Tomamos el order_id de la sesión
        $order_id = $_SESSION['order_id'] ?? null;

        if (!$order_id) {
            echo "Error: no hay una orden activa.";
            return;
        }

        $sql = "INSERT INTO order_items 
                (order_id, product_id, quantity, unit_price, text_line_1, text_line_2, engraving)
                VALUES (:order_id, :product_id, 1, :unit_price, :text1, :text2, :engraving)";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([
            ':order_id'   => $order_id,
            ':product_id' => $product_id,
            ':unit_price' => $this->getPrecioProducto($product_id),
            ':text1'      => $text1,
            ':text2'      => $text2,
            ':engraving'  => $engraving
        ]);

        echo "Producto agregado al pedido";
    }*/

    private function getPrecioProducto($product_id) {
        $sql  = "SELECT base_price FROM products WHERE id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $product_id]);
        $row  = $stmt->fetch(PDO::FETCH_ASSOC);
        return $row ? $row['base_price'] : 0;
    }

    // VER EL CARRITO

    public function verCarrito() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $order_id = $_SESSION['order_id'] ?? null;

    if (!$order_id) {
        $items = [];
    } else {
        $sql = "SELECT oi.*, p.name, p.image 
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :order_id";

        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':order_id' => $order_id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    require_once __DIR__ . '/../views/orders/carrito.php';
}
/*
    public function confirmarPedido() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    $order_id = $_SESSION['order_id'] ?? null;

    if (!$order_id) {
        echo "No hay pedido activo.";
        return;
    }

    $sql  = "UPDATE orders SET status = 'confirmed' WHERE id = :order_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':order_id' => $order_id]);

    // Limpiamos la sesión para que el próximo pedido arranque limpio
    unset($_SESSION['order_id']);

    require_once __DIR__ . '/../views/orders/confirmacion.php';
}*/
  /*public function confirmarPedido() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    // Si no está logueado, lo mandamos al login
    if (!isset($_SESSION['customer_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $order_id = $_SESSION['order_id'] ?? null;

    if (!$order_id) {
        echo "No hay pedido activo.";
        return;
    }

    $sql  = "UPDATE orders SET status = 'confirmed', customer_id = :customer_id WHERE id = :order_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':customer_id' => $_SESSION['customer_id'],
        ':order_id'    => $order_id
    ]);

    unset($_SESSION['order_id']);

    require_once __DIR__ . '/../views/orders/confirmacion.php';
}*/

public function confirmarPedido() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['customer_id'])) {
        header("Location: index.php?action=login");
        exit;
    }

    $order_id = $_SESSION['order_id'] ?? null;

    if (!$order_id) {
        echo "No hay pedido activo.";
        return;
    }

    // Calculamos el total sumando los items
    $sql_total = "SELECT SUM(unit_price * quantity) as total 
                  FROM order_items 
                  WHERE order_id = :order_id";
    $stmt_total = $this->conn->prepare($sql_total);
    $stmt_total->execute([':order_id' => $order_id]);
    $row   = $stmt_total->fetch(PDO::FETCH_ASSOC);
    $total = $row['total'] ?? 0;

    // Actualizamos la orden con el total real y el cliente
    $sql  = "UPDATE orders 
             SET status = 'confirmed', customer_id = :customer_id, total = :total 
             WHERE id = :order_id";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([
        ':customer_id' => $_SESSION['customer_id'],
        ':order_id'    => $order_id,
        ':total'       => $total
    ]);

    unset($_SESSION['order_id']);

    require_once __DIR__ . '/../views/orders/confirmacion.php';
}
}