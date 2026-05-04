<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= isset($producto) ? 'Editar' : 'Agregar' ?> Producto</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">

<nav class="navbar navbar-dark bg-dark px-4">
    <a class="navbar-brand fw-bold" href="index.php">🐾 Admin Petshop</a>
    <a href="index.php?action=productos" class="btn btn-outline-light btn-sm">← Volver</a>
</nav>

<div class="container mt-4">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body p-4">

                    <h4 class="mb-4"><?= isset($producto) ? '✏️ Editar producto' : '+ Agregar producto' ?></h4>

                    <form method="POST" 
                          action="index.php?action=<?= isset($producto) ? 'editarProducto&id=' . $producto['id'] : 'agregarProducto' ?>"
                          enctype="multipart/form-data">

                        <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input type="text" name="name" class="form-control" 
                                   value="<?= htmlspecialchars($producto['name'] ?? '') ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea name="description" class="form-control" rows="2"><?= htmlspecialchars($producto['description'] ?? '') ?></textarea>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Precio base</label>
                            <input type="number" name="base_price" class="form-control" step="0.01"
                                   value="<?= $producto['base_price'] ?? '' ?>" required>
                        </div>

                        <div class="mb-3">
                            <label class="form-label">Imagen</label>
                            <?php if (isset($producto) && $producto['image']): ?>
                                <div class="mb-2">
                                    <img src="<?= BASE_URL ?><?= $producto['image'] ?>" 
                                         style="height:80px; object-fit:contain;">
                                </div>
                            <?php endif; ?>
                            <input type="file" name="image" class="form-control" accept="image/*">
                            <small class="text-muted">Dejá vacío para mantener la imagen actual</small>
                        </div>

                        <div class="mb-4 form-check">
                            <input type="checkbox" name="active" value="1" class="form-check-input" 
                                   id="active" <?= ($producto['active'] ?? 1) ? 'checked' : '' ?>>
                            <label class="form-check-label" for="active">Activo (visible en catálogo)</label>
                        </div>

                        <button type="submit" class="btn btn-dark w-100">
                            <?= isset($producto) ? 'Guardar cambios' : 'Agregar producto' ?>
                        </button>
                    </form>

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