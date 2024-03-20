<?php
    include 'procesar.php';
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
</head>
<body>
    <h2> Iniciar sesión </h2>
    <form method="post" action="procesar.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>

        <?php if (isset($errores['credenciales'])): ?>
            <span style="color: red;"><?php echo $errores['credenciales']; ?></span><br>
        <?php endif; ?>
        
        <input type="submit" value="ENTRAR">
    </form>
</body>
</html>