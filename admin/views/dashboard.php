<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Admin Petshop</a>
    <a href="index.php?action=pedidos" class="btn btn-outline-light btn-sm">Ver Pedidos</a>
</nav>

<div class="container mt-4">
    <h4 class="mb-4">Resumen general</h4>

    <div class="row g-3">
        <div class="col-md-4">
            <div class="card text-white bg-primary">
                <div class="card-body">
                    <h6 class="card-title">Total pedidos</h6>
                    <h2><?= $total_pedidos ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-warning">
                <div class="card-body">
                    <h6 class="card-title">Pendientes</h6>
                    <h2><?= $pedidos_pending ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-success">
                <div class="card-body">
                    <h6 class="card-title">Confirmados</h6>
                    <h2><?= $pedidos_conf ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-secondary">
                <div class="card-body">
                    <h6 class="card-title">Clientes</h6>
                    <h2><?= $total_clientes ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-info">
                <div class="card-body">
                    <h6 class="card-title">Productos</h6>
                    <h2><?= $total_productos ?></h2>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="card text-white bg-dark">
                <div class="card-body">
                    <h6 class="card-title">Total facturado</h6>
                    <h2>$<?= number_format($facturado ?? 0, 2) ?></h2>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>