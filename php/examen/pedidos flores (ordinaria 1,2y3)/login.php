<?php
    require_once "funcionalidad.php";

    $errores = [];

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $usuario = isset($_POST["usuario"]) ? trim($_POST["usuario"]) : null;
        $password = isset($_POST["contrasena"]) ? trim($_POST["contrasena"]) : null;

        if (empty($usuario)) {
            $errores["usuario"] = "Debes introducir un usuario";
        }

        if (empty($password)) {
            $errores["contrasena"] = "Debes introducir una contraseña";
        }

        if(empty($errores)) {
            if (validarUsuario($usuario, $password)) {
                $_SESSION['usuario'] = obtenerInfoUsuarioPorNombre($usuario);

                header("Location: pedidos.php");
                die();
            } else {
                $errores["credenciales"] = "Credenciales incorrectas";
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inicio de sesión</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php if(isset($errores["credenciales"])): ?>
        <span class="error"><?= $errores["credenciales"] ?></span>
    <?php endif; ?>
    <!--formulario de login -->
    <form action="" method="post">
        <label for="usuario">Usuario</label>
        <input type="text" name="usuario">
        <?php if (isset($errores["usuario"])): ?>
            <span class="error"><?= $errores["usuario"] ?></span>
        <?php endif; ?>

        <label for="contrasena">Contraseña</label>
        <input type="password" name="contrasena">
        <?php if (isset($errores["contrasena"])): ?>
            <span class="error"><?= $errores["contrasena"] ?></span>
        <?php endif; ?>

        <input type="submit" value="Entrar">
    </form>

</body>
</html>