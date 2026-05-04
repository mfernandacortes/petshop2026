<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mi pedido</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Petshop Medallas</a>
    <div class="d-flex gap-2">
        <?php if (isset($_SESSION['customer_name'])): ?>
            <span class="text-white align-self-center small">Hola, <?= $_SESSION['customer_name'] ?></span>
            <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">Salir</a>
        <?php else: ?>
            <a href="index.php?action=login" class="btn btn-outline-light btn-sm">Ingresar</a>
        <?php endif; ?>
    </div>
</nav>

<div class="container mt-4">
    <h2 class="mb-4">🛒 Mi pedido</h2>

    <?php if (empty($items)): ?>
        <div class="alert alert-info text-center">
            No hay productos en tu pedido todavía.
            <br>
            <a href="index.php" class="btn btn-dark btn-sm mt-2">Ver catálogo</a>
        </div>
    <?php else: ?>
        <?php $total = 0; ?>

        <div class="row g-3">
            <?php foreach ($items as $item): ?>
            <div class="col-12">
                <div class="card shadow-sm">
                    <div class="card-body d-flex align-items-center gap-3">
                        <img src="<?= BASE_URL ?><?= $item['image'] ?>" 
                             alt="<?= htmlspecialchars($item['name']) ?>"
                             style="width:80px; height:80px; object-fit:contain;">
                        <div class="flex-grow-1">
                            <h6 class="mb-1 fw-bold"><?= htmlspecialchars($item['name']) ?></h6>
                            <?php if ($item['text_line_1']): ?>
                                <small class="text-muted">Línea 1: <?= htmlspecialchars($item['text_line_1']) ?></small><br>
                            <?php endif; ?>
                            <?php if ($item['text_line_2']): ?>
                                <small class="text-muted">Línea 2: <?= htmlspecialchars($item['text_line_2']) ?></small><br>
                            <?php endif; ?>
                            <small class="text-muted">Grabado: <?= $item['engraving'] ? 'Sí' : 'No' ?></small>
                        </div>
                        <div class="text-end">
                            <span class="fw-bold fs-5">$<?= number_format($item['unit_price'], 2) ?></span>
                        </div>
                    </div>
                </div>
            </div>
            <?php $total += $item['unit_price']; ?>
            <?php endforeach; ?>
        </div>

        <!-- Total y confirmar -->
        <div class="card mt-4 shadow-sm">
            <div class="card-body d-flex justify-content-between align-items-center">
                <h5 class="mb-0">Total</h5>
                <h4 class="mb-0 fw-bold">$<?= number_format($total, 2) ?></h4>
            </div>
        </div>

        <div class="d-grid gap-2 mt-3">
            <a href="index.php?action=confirmarPedido" class="btn btn-success btn-lg">✅ Confirmar pedido</a>
            <a href="index.php" class="btn btn-outline-secondary">← Seguir comprando</a>
        </div>

    <?php endif; ?>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Petshop Medallas &copy; 2026</small>
</footer>

</body>
</html>