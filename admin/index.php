<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/controllers/AdminController.php';
require_once __DIR__ . '/controllers/AuthController.php';

$action = $_GET['action'] ?? 'dashboard';

// Rutas públicas — no requieren login
$public = ['login'];

// Si no está logueado y no es ruta pública, redirigir al login
if (!isset($_SESSION['admin_id']) && !in_array($action, $public)) {
    header("Location: index.php?action=login");
    exit;
}

switch ($action) {

    case 'login':
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            (new AuthController())->login();
        } else {
            (new AuthController())->loginForm();
        }
        break;

    case 'logout':
        (new AuthController())->logout();
        break;

    case 'pedidos':
        (new AdminController())->pedidos();
        break;

    case 'detalle':
        (new AdminController())->detalle();
        break;

    case 'productos':
        (new AdminController())->productos();
        break;

    case 'agregarProducto':
        (new AdminController())->agregarProducto();
        break;

    case 'editarProducto':
        (new AdminController())->editarProducto();
        break;

    case 'toggleActivo':
        (new AdminController())->toggleActivo();
        break;

    case 'clientes':
        (new AdminController())->clientes();
        break;

    case 'detalleCliente':
        (new AdminController())->detalleCliente();
        break;

    default:
        (new AdminController())->dashboard();
        break;
}