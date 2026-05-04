<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Pedido confirmado</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Petshop Medallas</a>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6 text-center">
            <div class="card shadow-sm">
                <div class="card-body p-5">

                    <div class="mb-4" style="font-size: 4rem;">✅</div>

                    <h3 class="fw-bold mb-2">¡Pedido confirmado!</h3>
                    <p class="text-muted mb-4">Tu pedido fue recibido correctamente. En breve nos ponemos en contacto.</p>

                    <div class="alert alert-success fs-5">
                        Total abonado: <strong>$<?= number_format($total, 2) ?></strong>
                    </div>

                    <a href="index.php" class="btn btn-dark w-100 mt-2">← Volver al catálogo</a>

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