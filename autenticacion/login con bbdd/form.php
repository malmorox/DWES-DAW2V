<?php
    require 'conexion.php';

    $errores = [];

    // Verificamos si se ha enviado el formulario
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = $_POST['usuario'];
        $contrasena = $_POST['contrasena'];

        if (!iniciarSesion($usuario, $contrasena)) {
            $errores['credenciales'] = "Credenciales incorrectas.";
        }

        if (empty($errores)) {
            $usuario = urlencode($usuario);
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
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>

        <?php if (isset($errores['credenciales'])): ?>
            <span style="color: red;"><?php echo $errores['credenciales']; ?></span><br>
        <?php endif; ?>
        
        <input type="submit" value="ENTRAR">
    </form>
</body>
</html>