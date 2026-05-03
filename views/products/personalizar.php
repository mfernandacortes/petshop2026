<h2><?= $product['name'] ?></h2>

<img src="<?= BASE_URL ?><?= $product['image'] ?>" width="150">

<p>Precio: $<?= $product['base_price'] ?></p>

<form method="POST" action="index.php?action=guardarPedido">

    <input type="hidden" name="product_id" value="<?= $product['id'] ?>">

    <label>Texto línea 1:</label><br>
    <input type="text" name="text1"><br><br>

    <label>Texto línea 2:</label><br>
    <input type="text" name="text2"><br><br>

    <label>
        <input type="checkbox" name="engraving" value="1">
        Grabado
    </label><br><br>

    <button type="submit">Agregar al pedido</button>

</form>
<a href="index.php?action=carrito">Ver mi pedido</a>