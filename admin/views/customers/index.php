<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Clientes</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="index.php">🐾 Admin Petshop</a>
    <div class="d-flex gap-2">
        <a href="index.php" class="btn btn-outline-light btn-sm">Dashboard</a>
        <a href="index.php?action=pedidos" class="btn btn-outline-warning btn-sm">📋 Pedidos</a>
        <a href="index.php?action=productos" class="btn btn-outline-light btn-sm">🏅 Productos</a>
    </div>
</nav>

<div class="container mt-4">
    <h4 class="mb-4">👤 Clientes</h4>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Nombre</th>
                    <th>Email</th>
                    <th>Teléfono</th>
                    <th>Dirección</th>
                    <th>Registrado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($clientes as $c): ?>
                <tr>
                    <td><?= $c['id'] ?></td>
                    <td><?= htmlspecialchars($c['name']) ?></td>
                    <td><?= htmlspecialchars($c['email']) ?></td>
                    <td><?= htmlspecialchars($c['phone'] ?? '-') ?></td>
                    <td><?= htmlspecialchars($c['address'] ?? '-') ?></td>
                    <td><?= date('d/m/Y', strtotime($c['created_at'])) ?></td>
                    <td>
                        <a href="index.php?action=detalleCliente&id=<?= $c['id'] ?>" 
                           class="btn btn-sm btn-outline-dark">Ver detalle</a>
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Admin Petshop &copy; 2026</small>
</footer>

</body>
</html>