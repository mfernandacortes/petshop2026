<!DOCTYPE html>
<html>
<head>
    <title>Mi pedido</title>
</head>
<body>

<h1>Mi pedido</h1>

<?php if (empty($items)): ?>
    <p>No hay productos en tu pedido todavía.</p>
<?php else: ?>
    <?php $total = 0; ?>
    <?php foreach ($items as $item): ?>
        <div style="border:1px solid #ccc; margin-bottom:16px; padding:12px;">
            <img src="<?= BASE_URL ?><?= $item['image'] ?>" width="80">
            <strong><?= $item['name'] ?></strong><br>
            Línea 1: <?= $item['text_line_1'] ?><br>
            Línea 2: <?= $item['text_line_2'] ?><br>
            Grabado: <?= $item['engraving'] ? 'Sí' : 'No' ?><br>
            Precio: $<?= $item['unit_price'] ?>
        </div>
        <?php $total += $item['unit_price']; ?>
    <?php endforeach; ?>

    <h3>Total: $<?= $total ?></h3>

    <a href="index.php?action=confirmarPedido">
        <button>Confirmar pedido</button>
    </a>
<?php endif; ?>

<br>
<a href="index.php">← Seguir comprando</a>

</body>
</html>