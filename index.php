<?php

// Primero la configuración
ini_set('session.gc_maxlifetime', 1800);
session_set_cookie_params(1800);

// Después arrancamos la sesión
session_start();

// Expiración de sesión en 30 minutos
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity'] > 1800)) {
    session_unset();
    session_destroy();
    session_start();
}
$_SESSION['last_activity'] = time();
$_SESSION['last_activity'] = time();

require_once __DIR__ . '/controllers/ProductController.php';
require_once __DIR__ . '/controllers/OrderController.php';
require_once __DIR__ . '/controllers/CustomerController.php';

$action = $_GET['action'] ?? 'index';

switch ($action) {

    case 'personalizar':
        (new ProductController())->personalizar();
        break;

    case 'guardarPedido':
        (new OrderController())->guardarPedido();
        break;

    case 'carrito':
        (new OrderController())->verCarrito();
        break;

    case 'confirmarPedido':
        (new OrderController())->confirmarPedido();
        break;

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new CustomerController())->login();
        } else {
            (new CustomerController())->loginForm();
        }
        break;

    case 'registro':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new CustomerController())->registro();
        } else {
            (new CustomerController())->registroForm();
        }
        break;

    case 'logout':
        (new CustomerController())->logout();
        break;

    default:
        $orderController = new OrderController();
        $orderController->iniciarOrden();
        (new ProductController())->index();
        break;
}