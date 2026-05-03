<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
</head>
<body>

<h1>Iniciar sesión</h1>

<?php if (isset($error)): ?>
    <p style="color:red"><?= $error ?></p>
<?php endif; ?>

<form method="POST" action="index.php?action=login">
    <label>Email:</label><br>
    <input type="email" name="email"><br><br>

    <label>Contraseña:</label><br>
    <input type="password" name="password"><br><br>

    <button type="submit">Ingresar</button>
</form>

<br>
<a href="index.php?action=registro">¿No tenés cuenta? Registrate</a>

</body>
</html>