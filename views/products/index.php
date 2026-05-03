<!DOCTYPE html>
<html>
<head>
    <title>Productos</title>
</head>
<body>

<h1>Catálogo de Medallas</h1>
<h1> ver si sale estoy en products index </h1>
<?php foreach ($products as $p): ?>
    <div style="margin-bottom:20px;">
        <h3><?= $p['name']; ?></h3>
       <?php echo "aca deberia verse q hay en image linea 13 ". $p['image']; ?>
        <img src="<?= BASE_URL ?><?= $p['image'] ?>" width="150">
       
        <p>$<?= $p['base_price'] ?></p>

        <a href="index.php?action=personalizar&id=<?= $p['id'] ?>">
            <button>Personalizar</button>
        </a>
    </div>
<?php endforeach; ?>

</body>
</html>