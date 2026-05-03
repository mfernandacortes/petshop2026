<!DOCTYPE html>
<html>
<head>
    <title>Registro</title>
</head>
<body>

<h1>Crear cuenta</h1>

<?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=registro">
    <label>Nombre:</label><br>
    <input type="text" name="name"><br><br>

    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Teléfono:</label><br>
    <input type="text" name="phone"><br><br>

    <label>Dirección:</label><br>
    <input type="text" name="address"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Registrarse</button>
</form>

<br>
<a href="index.php?action=login">¿Ya tenés cuenta? Ingresá</a>

</body>
</html>