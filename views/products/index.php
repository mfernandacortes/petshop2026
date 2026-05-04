<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Catálogo de Medallas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Petshop Medallas</a>
    <div class="d-flex gap-2">
        <a href="index.php?action=carrito" class="btn btn-outline-warning btn-sm">🛒 Ver pedido</a>
        <?php if (isset($_SESSION['customer_name'])): ?>
            <span class="text-white align-self-center small">Hola, <?= $_SESSION['customer_name'] ?></span>
            <a href="index.php?action=logout" class="btn btn-outline-light btn-sm">Salir</a>
        <?php else: ?>
            <a href="index.php?action=login" class="btn btn-outline-light btn-sm">Ingresar</a>
        <?php endif; ?>
    </div>
</nav>

<!-- Catálogo -->
<div class="container mt-4">
    <h2 class="mb-4 text-center">Catálogo de Medallas</h2>

    <div class="row row-cols-1 row-cols-md-3 row-cols-lg-4 g-4">
        <?php foreach ($products as $p): ?>
        <div class="col">
            <div class="card h-100 shadow-sm">
                <img src="<?= BASE_URL ?><?= $p['image'] ?>" 
                     class="card-img-top p-3" 
                     alt="<?= htmlspecialchars($p['name']) ?>"
                     style="height: 200px; object-fit: contain;">
                <div class="card-body text-center">
                    <h6 class="card-title"><?= htmlspecialchars($p['name']) ?></h6>
                    <p class="text-muted fw-bold">$<?= number_format($p['base_price'], 2) ?></p>
                    <a href="index.php?action=personalizar&id=<?= $p['id'] ?>" 
                       class="btn btn-dark btn-sm w-100">Personalizar</a>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    </div>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Petshop Medallas &copy; 2026</small>
</footer>

</body>
</html>