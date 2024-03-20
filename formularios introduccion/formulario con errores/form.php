<?php
    $errores = [];

    // Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if ($_POST['usuario'] !== 'Marcos') {
            $errores['usuario'] = "El usuario ingresado es incorrecto.";
        }

        if ($_POST['contrasena'] !== '1234') {
            $errores['contrasena'] = "La contraseña ingresada es incorrecta.";
        }

        if (empty($errores)) {
            $usuario = urlencode($_POST['usuario']);
            header("Location: exito.php?usuario=$usuario");
            exit();
        }
    }
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
    <form method="post" action="form.php">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"><br>
        <?php if (isset($errores['usuario'])): ?>
            <span style="color: red;"><?php echo $errores['usuario']; ?></span><br>
        <?php endif; ?>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>
        <?php if (isset($errores['contrasena'])): ?>
            <span style="color: red;"><?php echo $errores['contrasena']; ?></span><br>
        <?php endif; ?>
        
        <input type="submit" value="ENTRAR">
    </form>
</body>
</html>