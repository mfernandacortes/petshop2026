<?php
session_start();
require_once __DIR__ . '/../config/config.php';
require_once __DIR__ . '/controllers/AdminController.php';

$action = $_GET['action'] ?? 'dashboard';

switch ($action) {
    case 'pedidos':
        (new AdminController())->pedidos();
        break;
    case 'detalle':
        (new AdminController())->detalle();
        break;
    default:
        (new AdminController())->dashboard();
        break;
}