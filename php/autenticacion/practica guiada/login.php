<?php

    require_once 'init.php';

    if (isset($_SESSION['usuario'])) {
        header("Location: index.php");
        exit();
    }

    $errores = [];
    $nombre = "";
    $contrasena = "";

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $nombre = isset($_POST['nombre']) ? trim($_POST['nombre']) : null;
        $contrasena = isset($_POST['contrasena']) ? trim($_POST['contrasena']) : null;
        $recordar = isset($_POST['recordar']) ? true : false;

        if (empty($nombre)) {
            $errores['nombre'] = "El nombre de usuario es obligatorio";
        }                                    

        if (empty($contrasena)) {
            $errores['contrasena'] = "La contraseña es obligatoria";
        }

        if (empty($errores)) {
            $usuario = $db->ejecuta("SELECT * FROM usuarios WHERE nombre = :nombre", $nombre);
            $usuario = $db->obtenDato();
            //print_r($usuario);
                
            if (password_verify($contrasena, $usuario['pass'])) {
                $_SESSION['usuario'] = $usuario['nombre'];
                //$_SESSION['usuario'] = $nombre;

                if ($recordar) {
                    $token = generarToken();
                    $expiracion = time() + TIEMPO_EXPIRACION_RECUERDAME;
        
                    guardarToken($token, $usuario['id'], date('Y-m-d H:i:s', $expiracion), 0);
        
                    setcookie('recuerdame', $token, $expiracion, '/');
                }

                header("Location: index.php");
                exit();
            } else {
                $errores['credenciales'] = "Credenciales incorrectas";
            }
        }
        
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Login </title>
    <style>
        .error {
            color: red;
        }
    </style>
</head>
<body>
    <h1> Inicio de sesión </h1>
    <?php if (isset($errores['credenciales'])): ?>
        <span class="error"> <?= $errores['credenciales'] ?> </span> <br>
    <?php endif; ?>
    <form action="" method="post">
        <input type="text" name="nombre" value="<?= $nombre ?>"> <br>
        <?php if (isset($errores['nombre'])): ?>
            <span class="error"> <?= $errores['nombre'] ?> </span> 
        <?php endif; ?> <br>

        <input type="password" name="contrasena" value="<?= $contrasena ?>"> <br>
        <?php if (isset($errores['contrasena'])): ?>
            <span class="error"> <?= $errores['contrasena'] ?> </span>
        <?php endif; ?> <br>

        <input type="checkbox" name="recordar"> Recordarme <br>
        <input type="submit" name="loguearte" value="Iniciar sesión">
    </form>
</body>
</html>