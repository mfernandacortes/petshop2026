<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Iniciar sesión</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<!-- Navbar -->
<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand" href="index.php">🐾 Petshop Medallas</a>
</nav>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h4 class="text-center mb-4">Iniciar sesión</h4>

                    <?php if (isset($error)): ?>
                        <div class="alert alert-danger"><?= $error ?></div>
                    <?php endif; ?>

                    <form method="POST" action="index.php?action=login">

                        <div class="mb-3">
                            <label class="form-label">Email</label>
                            <input type="email" name="email" class="form-control" placeholder="tu@email.com" required>
                        </div>

                        <div class="mb-4">
                            <label class="form-label">Contraseña</label>
                            <input type="password" name="password" class="form-control" placeholder="••••••••" required>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">Ingresar</button>
                    </form>

                    <hr>

                    <p class="text-center mb-0 small">
                        ¿No tenés cuenta? 
                        <a href="index.php?action=registro">Registrate</a>
                    </p>

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