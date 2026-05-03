<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Admin - Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Admin Petshop</a>
    <a href="index.php" class="btn btn-outline-light btn-sm">Dashboard</a>
</nav>

<div class="container mt-4">
    <h4 class="mb-4">Listado de pedidos</h4>

    <table class="table table-bordered table-hover bg-white">
        <thead class="table-dark">
            <tr>
                <th>#</th>
                <th>Cliente</th>
                <th>Email</th>
                <th>Teléfono</th>
                <th>Total</th>
                <th>Estado</th>
                <th>Fecha</th>
                <th></th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($pedidos as $p): ?>
            <tr>
                <td><?= $p['id'] ?></td>
                <td><?= htmlspecialchars($p['cliente']) ?></td>
                <td><?= htmlspecialchars($p['email']) ?></td>
                <td><?= htmlspecialchars($p['phone']) ?></td>
                <td>$<?= number_format($p['total'], 2) ?></td>
                <td>
                    <?php
                    $badges = [
                        'pending'       => 'warning',
                        'confirmed'     => 'success',
                        'in_production' => 'info',
                        'completed'     => 'primary',
                        'cancelled'     => 'danger'
                    ];
                    $badge = $badges[$p['status']] ?? 'secondary';
                    ?>
                    <span class="badge bg-<?= $badge ?>"><?= $p['status'] ?></span>
                </td>
                <td><?= date('d/m/Y H:i', strtotime($p['created_at'])) ?></td>
                <td>
                    <a href="index.php?action=detalle&id=<?= $p['id'] ?>" class="btn btn-sm btn-outline-dark">Ver detalle</a>
                </td>
            </tr>
        <?php endforeach; ?>
        </tbody>
    </table>
</div>

</body>
</html>