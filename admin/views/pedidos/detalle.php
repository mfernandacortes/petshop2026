<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Pedido #<?= $pedido['id'] ?></title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        @media print { .no-print { display: none; } }
    </style>
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4 no-print">
    <a class="navbar-brand" href="index.php">🐾 Admin Petshop</a>
    <div class="d-flex gap-2">
        <a href="index.php?action=pedidos" class="btn btn-outline-light btn-sm">← Volver</a>
        <button onclick="window.print()" class="btn btn-outline-warning btn-sm">🖨️ Imprimir</button>
    </div>
</nav>

<div class="container mt-4">
    <div class="card">
        <div class="card-body">

            <!-- Encabezado -->
            <div class="row mb-4">
                <div class="col-md-6">
                    <h5><strong>Pedido #<?= $pedido['id'] ?></strong></h5>
                    <span class="badge bg-<?= $badges[$pedido['status']] ?? 'secondary' ?> mb-2"><?= $pedido['status'] ?></span>
                    <p class="text-muted">Fecha: <?= date('d/m/Y H:i', strtotime($pedido['created_at'])) ?></p>
                </div>
                <div class="col-md-6 text-md-end">
                    <h5><strong>Datos del cliente</strong></h5>
                    <p class="mb-0"><?= htmlspecialchars($pedido['cliente']) ?></p>
                    <p class="mb-0"><?= htmlspecialchars($pedido['email']) ?></p>
                    <p class="mb-0"><?= htmlspecialchars($pedido['phone']) ?></p>
                    <p class="mb-0"><?= htmlspecialchars($pedido['address']) ?></p>
                </div>
            </div>

            <hr>

            <!-- Items -->
            <table class="table table-bordered">
                <thead class="table-dark">
                    <tr>
                        <th>Imagen</th>
                        <th>Producto</th>
                        <th>Línea 1</th>
                        <th>Línea 2</th>
                        <th>Grabado</th>
                        <th>Cantidad</th>
                        <th>Precio unit.</th>
                    </tr>
                </thead>
                <tbody>
                <?php foreach ($items as $item): ?>
                    <tr>
                        <td><img src="<?= BASE_URL ?><?= $item['image'] ?>" width="60"></td>
                        <td><?= htmlspecialchars($item['producto']) ?></td>
                        <td><?= htmlspecialchars($item['text_line_1']) ?></td>
                        <td><?= htmlspecialchars($item['text_line_2']) ?></td>
                        <td><?= $item['engraving'] ? 'Sí' : 'No' ?></td>
                        <td><?= $item['quantity'] ?></td>
                        <td>$<?= number_format($item['unit_price'], 2) ?></td>
                    </tr>
                <?php endforeach; ?>
                </tbody>
            </table>

            <!-- Total -->
            <div class="row">
                <div class="col-md-6 offset-md-6 text-end">
                    <h5><strong>Total: $<?= number_format($pedido['total'], 2) ?></strong></h5>
                </div>
            </div>

        </div>
    </div>
</div>

</body>
</html>