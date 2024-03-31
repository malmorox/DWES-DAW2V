<?php
    $errores = [];

    if(isset($_POST['submit'])) {
        if($_POST['usuario'] === 'marcos' && $_POST['password'] === '1234') {
            session_start();
            $_SESSION['usuario'] = $_POST['usuario'];

            if(isset($_POST['recordar']) && $_POST['recordar'] == 'recordar') {
                // Cookie para recordar al usuario durante 7 días
                setcookie('usuario', $_POST['usuario'], time() + (3600 * 24 * 7), "/");
            }

            header('Location: exito.php');
            exit;
        } else {
            $errores['credenciales'] = "Usuario o contraseña incorrectos";
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
    <?php if (isset($errores['credenciales'])): ?>
            <span style="color: red;"><?php echo $errores['credenciales']; ?></span><br>
    <?php endif; ?>
    <form method="post">
        <label for="usuario">Usuario:</label><br>
        <input type="text" id="usuario" name="usuario"><br><br>
        <label for="password">Contraseña:</label><br>
        <input type="password" id="password" name="password"><br><br>
        <input type="checkbox" id="recordar" name="recordar" value="Recordarme">
        <label for="recordar">Recordar sesión</label><br><br>
        <input type="submit" name="submit" value="Iniciar sesión">
    </form>
</body>
</html>