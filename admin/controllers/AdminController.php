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
            header("Location: index.php?action=pedidos");
            exit;
        }

        $sql = "SELECT o.*, c.name AS cliente, c.email, c.phone, c.address
                FROM orders o
                JOIN customers c ON o.customer_id = c.id
                WHERE o.id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $pedido = $stmt->fetch(PDO::FETCH_ASSOC);

        $sql = "SELECT oi.*, p.name AS producto, p.image
                FROM order_items oi
                JOIN products p ON oi.product_id = p.id
                WHERE oi.order_id = :id";
        $stmt = $this->conn->prepare($sql);
        $stmt->execute([':id' => $id]);
        $items = $stmt->fetchAll(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/pedidos/detalle.php';
    }

    public function productos() {
        $productos = $this->conn->query("SELECT * FROM products ORDER BY id")->fetchAll(PDO::FETCH_ASSOC);
        require_once __DIR__ . '/../views/products/index.php';
    }

    public function agregarProducto() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'] ?? null;
            $base_price  = $_POST['base_price'];
            $active      = isset($_POST['active']) ? 1 : 0;

            $image = null;
            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = strtolower(str_replace(' ', '_', $name)) . '.' . $ext;
                $destino  = __DIR__ . '/../../public/images/medallas/' . $filename;
                move_uploaded_file($_FILES['image']['tmp_name'], $destino);
                $image = 'public/images/medallas/' . $filename;
            }

            $sql  = "INSERT INTO products (name, description, base_price, image, active) 
                     VALUES (:name, :description, :base_price, :image, :active)";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name'        => $name,
                ':description' => $description,
                ':base_price'  => $base_price,
                ':image'       => $image,
                ':active'      => $active
            ]);

            header("Location: index.php?action=productos");
            exit;
        }

        require_once __DIR__ . '/../views/products/form.php';
    }

    public function editarProducto() {
        $id = $_GET['id'] ?? null;
        if (!$id) {
            header("Location: index.php?action=products");
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name        = $_POST['name'];
            $description = $_POST['description'] ?? null;
            $base_price  = $_POST['base_price'];
            $active      = isset($_POST['active']) ? 1 : 0;

            $stmt_img = $this->conn->prepare("SELECT image FROM products WHERE id = :id");
            $stmt_img->execute([':id' => $id]);
            $image = $stmt_img->fetchColumn();

            if (isset($_FILES['image']) && $_FILES['image']['error'] === 0) {
                $ext      = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
                $filename = strtolower(str_replace(' ', '_', $name)) . '.' . $ext;
                $destino  = __DIR__ . '/../../public/images/medallas/' . $filename;
                move_uploaded_file($_FILES['image']['tmp_name'], $destino);
                $image = 'public/images/medallas/' . $filename;
            }

            $sql  = "UPDATE products SET name = :name, description = :description, 
                     base_price = :base_price, image = :image, active = :active 
                     WHERE id = :id";
            $stmt = $this->conn->prepare($sql);
            $stmt->execute([
                ':name'        => $name,
                ':description' => $description,
                ':base_price'  => $base_price,
                ':image'       => $image,
                ':active'      => $active,
                ':id'          => $id
            ]);

            header("Location: index.php?action=productos");
            exit;
        }

        $stmt = $this->conn->prepare("SELECT * FROM products WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $producto = $stmt->fetch(PDO::FETCH_ASSOC);

        require_once __DIR__ . '/../views/products/form.php';
    }

    public function toggleActivo() {
        $id = $_GET['id'] ?? null;
        if ($id) {
            $stmt = $this->conn->prepare("UPDATE products SET active = !active WHERE id = :id");
            $stmt->execute([':id' => $id]);
        }
        header("Location: index.php?action=products");
        exit;
    }

    //***********clientes  *************************/
    public function clientes() {
    $clientes = $this->conn->query("SELECT * FROM customers ORDER BY id DESC")->fetchAll(PDO::FETCH_ASSOC);
    require_once __DIR__ . '/../views/customers/index.php';
}

public function detalleCliente() {
    $id = $_GET['id'] ?? null;
    if (!$id) {
        header("Location: index.php?action=clientes");
        exit;
    }

    $stmt = $this->conn->prepare("SELECT * FROM customers WHERE id = :id");
    $stmt->execute([':id' => $id]);
    $cliente = $stmt->fetch(PDO::FETCH_ASSOC);

    $sql = "SELECT o.id, o.status, o.total, o.created_at 
            FROM orders o 
            WHERE o.customer_id = :id 
            ORDER BY o.created_at DESC";
    $stmt = $this->conn->prepare($sql);
    $stmt->execute([':id' => $id]);
    $pedidos = $stmt->fetchAll(PDO::FETCH_ASSOC);

    require_once __DIR__ . '/../views/customers/detalle.php';
}


}