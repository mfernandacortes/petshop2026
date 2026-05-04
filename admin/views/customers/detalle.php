<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Cliente - <?= htmlspecialchars($cliente['name']) ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="index.php">🐾 Admin Petshop</a>
    <a href="index.php?action=clientes" class="btn btn-outline-light btn-sm">← Volver</a>
</nav>

<div class="container mt-4">
    <div class="row g-4">

        <!-- Datos del cliente -->
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">👤 Datos del cliente</h5>
                    <ul class="list-unstyled">
                        <li class="mb-2"><strong>Nombre:</strong> <?= htmlspecialchars($cliente['name']) ?></li>
                        <li class="mb-2"><strong>Email:</strong> <?= htmlspecialchars($cliente['email']) ?></li>
                        <li class="mb-2"><strong>Teléfono:</strong> <?= htmlspecialchars($cliente['phone'] ?? '-') ?></li>
                        <li class="mb-2"><strong>Dirección:</strong> <?= htmlspecialchars($cliente['address'] ?? '-') ?></li>
                        <li class="mb-2"><strong>Registrado:</strong> <?= date('d/m/Y', strtotime($cliente['created_at'])) ?></li>
                    </ul>
                </div>
            </div>
        </div>

        <!-- Pedidos del cliente -->
        <div class="col-md-8">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="mb-3">📋 Pedidos</h5>

                    <?php if (empty($pedidos)): ?>
                        <p class="text-muted">Este cliente no tiene pedidos todavía.</p>
                    <?php else: ?>
                        <table class="table table-bordered">
                            <thead class="table-dark">
                                <tr>
                                    <th>#</th>
                                    <th>Estado</th>
                                    <th>Total</th>
                                    <th>Fecha</th>
                                    <th></th>
                                </tr>
                            </thead>
                            <tbody>
                            <?php 
                            $badges = [
                                'pending'       => 'warning',
                                'confirmed'     => 'success',
                                'in_production' => 'info',
                                'completed'     => 'primary',
                                'cancelled'     => 'danger'
                            ];
                            foreach ($pedidos as $p): ?>
                                <tr>
                                    <td><?= $p['id'] ?></td>
                                    <td>
                                        <span class="badge bg-<?= $badges[$p['status']] ?? 'secondary' ?>">
                                            <?= $p['status'] ?>
                                        </span>
                                    </td>
                                    <td>$<?= number_format($p['total'], 2) ?></td>
                                    <td><?= date('d/m/Y', strtotime($p['created_at'])) ?></td>
                                    <td>
                                        <a href="index.php?action=detalle&id=<?= $p['id'] ?>" 
                                           class="btn btn-sm btn-outline-dark">Ver</a>
                                    </td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    <?php endif; ?>
                </div>
            </div>
        </div>

    </div>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Admin Petshop &copy; 2026</small>
</footer>

</body>
</html>