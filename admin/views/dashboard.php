<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="index.php">🐾 Admin Petshop</a>
    <div class="d-flex gap-2">
        <a href="index.php?action=pedidos" class="btn btn-outline-warning btn-sm">📋 Pedidos</a>
        <a href="index.php?action=productos" class="btn btn-outline-light btn-sm">🏅 Productos</a>
        <a href="index.php?action=clientes" class="btn btn-outline-light btn-sm">👤 Clientes</a>
        <a href="index.php?action=logout" class="btn btn-outline-danger btn-sm">Salir</a>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="mb-1">Dashboard</h4>
    <p class="text-muted mb-4">Resumen general del sistema</p>

    <div class="row g-3">
        <div class="col-md-4 col-6">
            <div class="card text-white bg-primary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Total pedidos</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_pedidos ?></h2>
                        </div>
                        <span style="font-size:2rem">📦</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6">
            <div class="card text-dark bg-warning shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Pendientes</h6>
                            <h2 class="mb-0 fw-bold"><?= $pedidos_pending ?></h2>
                        </div>
                        <span style="font-size:2rem">⏳</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6">
            <div class="card text-white bg-success shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Confirmados</h6>
                            <h2 class="mb-0 fw-bold"><?= $pedidos_conf ?></h2>
                        </div>
                        <span style="font-size:2rem">✅</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6">
            <div class="card text-white bg-secondary shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Clientes</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_clientes ?></h2>
                        </div>
                        <span style="font-size:2rem">👤</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6">
            <div class="card text-white bg-info shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Productos</h6>
                            <h2 class="mb-0 fw-bold"><?= $total_productos ?></h2>
                        </div>
                        <span style="font-size:2rem">🏅</span>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-4 col-6">
            <div class="card text-white bg-dark shadow-sm">
                <div class="card-body">
                    <div class="d-flex justify-content-between align-items-center">
                        <div>
                            <h6 class="card-title mb-0 opacity-75">Total facturado</h6>
                            <h2 class="mb-0 fw-bold">$<?= number_format($facturado ?? 0, 2) ?></h2>
                        </div>
                        <span style="font-size:2rem">💰</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Acceso rápido -->
    <h5 class="mt-5 mb-3">Acceso rápido</h5>
    <div class="row g-3">
        <div class="col-md-4">
            <a href="index.php?action=pedidos" class="btn btn-outline-dark w-100 py-3">
                📋 Ver pedidos
            </a>
        </div>
        <div class="col-md-4">
            <a href="index.php?action=productos" class="btn btn-outline-dark w-100 py-3">
                🏅 Ver productos
            </a>
        </div>
        <div class="col-md-4">
            <a href="index.php?action=clientes" class="btn btn-outline-dark w-100 py-3">
                👤 Ver clientes
            </a>
        </div>
    </div>

</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Admin Petshop &copy; 2026</small>
</footer>

</body>
</html>