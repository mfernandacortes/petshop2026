<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Personalizar - <?= htmlspecialchars($product['name']) ?></title>
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

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body text-center">

                    <!-- Imagen y datos del producto -->
                    <img src="<?= BASE_URL ?><?= $product['image'] ?>" 
                         alt="<?= htmlspecialchars($product['name']) ?>"
                         style="height: 180px; object-fit: contain;" class="mb-3">
                    <h4><?= htmlspecialchars($product['name']) ?></h4>
                    <p class="text-muted fw-bold fs-5">$<?= number_format($product['base_price'], 2) ?></p>

                    <hr>

                    <!-- Formulario -->
                    <form method="POST" action="index.php?action=guardarPedido">
                        <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold">Texto línea 1</label>
                            <input type="text" name="text1" class="form-control" placeholder="Ej: Firulais">
                        </div>

                        <div class="mb-3 text-start">
                            <label class="form-label fw-semibold">Texto línea 2</label>
                            <input type="text" name="text2" class="form-control" placeholder="Ej: Tel: 1234-5678">
                        </div>

                        <div class="mb-4 text-start form-check">
                            <input type="checkbox" name="engraving" value="1" class="form-check-input" id="engraving">
                            <label class="form-check-label" for="engraving">Grabado especial</label>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Agregar al pedido</button>
                    </form>

                    <a href="index.php" class="btn btn-outline-secondary w-100 mt-2">← Volver al catálogo</a>
                    <a href="index.php?action=carrito" class="btn btn-outline-warning w-100 mt-2">🛒 Ver mi pedido</a>

                </div>
            </div>
        </div>
    </div>
</div>

<footer class="text-center text-muted mt-5 mb-3">
    <small>🐾 Petshop Medallas &copy; 2026</small>
</footer>

</body>
</html>