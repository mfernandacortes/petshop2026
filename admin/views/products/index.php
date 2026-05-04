<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Admin - Productos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="index.php">🐾 Admin Petshop</a>
    <div class="d-flex gap-2">
        <a href="index.php" class="btn btn-outline-light btn-sm">Dashboard</a>
        <a href="index.php?action=pedidos" class="btn btn-outline-warning btn-sm">📋 Pedidos</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h4 class="mb-0">🏅 Productos</h4>
        <a href="index.php?action=agregarProducto" class="btn btn-dark btn-sm">+ Agregar producto</a>
    </div>

    <div class="table-responsive">
        <table class="table table-bordered table-hover bg-white shadow-sm">
            <thead class="table-dark">
                <tr>
                    <th>#</th>
                    <th>Imagen</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Precio</th>
                    <th>Estado</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
            <?php foreach ($productos as $p): ?>
                <tr>
                    <td><?= $p['id'] ?></td>
                    <td>
                        <img src="<?= BASE_URL ?><?= $p['image'] ?>" 
                             style="width:50px; height:50px; object-fit:contain;">
                    </td>
                    <td><?= htmlspecialchars($p['name']) ?></td>
                    <td><?= htmlspecialchars($p['description'] ?? '-') ?></td>
                    <td>$<?= number_format($p['base_price'], 2) ?></td>
                    <td>
                        <a href="index.php?action=toggleActivo&id=<?= $p['id'] ?>">
                            <?php if ($p['active']): ?>
                                <span class="badge bg-success">Activo</span>
                            <?php else: ?>
                                <span class="badge bg-secondary">Inactivo</span>
                            <?php endif; ?>
                        </a>
                    </td>
                    <td>
                        <a href="index.php?action=editarProducto&id=<?= $p['id'] ?>" 
                           class="btn btn-sm btn-outline-dark">✏️ Editar</a>
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