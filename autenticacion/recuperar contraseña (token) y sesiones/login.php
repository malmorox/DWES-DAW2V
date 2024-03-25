<?php

require_once "conexion.php";
session_start();

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];

    if (iniciarSesion($usuario, $contrasena)) {
        $_SESSION["loggedin"] = true;
        $_SESSION["usuario"] = $usuario;
        header("Location: exito.php?usuario=" . urlencode($usuario));
        exit;
    } else {
        $errores['credenciales'] = "Usuario o contraseña incorrectos.";
    }
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar sesión</title>
</head>
<body>
    <h2>Iniciar sesión</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="usuario">Usuario:</label>
        <input type="text" id="usuario" name="usuario" required value="<?php echo isset($_POST['usuario']) ? htmlspecialchars($_POST['usuario']) : ''; ?>"><br>
        
        <label for="contrasena">Contraseña:</label>
        <input type="password" id="contrasena" name="contrasena" required><br>
        
        <?php if (isset($errores['credenciales'])): ?>
            <span style="color: red;"><?php echo $errores['credenciales']; ?></span><br>
        <?php endif; ?>
        
        <input type="submit" value="ENTRAR">
    </form>
    <p><a href="recuperar-contra.php">¿Olvidaste tu contraseña?</a></p>
</body>
</html>