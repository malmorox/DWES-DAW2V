<?php
    require_once "funcionalidad.php";

    $errores = [];
    $cambio_contrasena_exitoso = false;

    if(!isset($_GET["token"]) || empty($_GET["token"]) || !validarToken($_GET["token"])) {
        header("Location: recupera_listado.php");
        die();
    } else{
        $token = $_GET["token"];

        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $nueva_contrasena = isset($_POST["nueva_contrasena"]) ? trim($_POST["nueva_contrasena"]) : null;
            
            if (empty($nueva_contrasena)) {
                $errores["nueva_contrasena"] = "Debes introducir una contraseña";
            } else if (!validarNuevaContrasena($nueva_contrasena)) {
                $errores["nueva_contrasena"] = "La contraseña no puede ser igual a la anterior";
            }

            if (empty($errores)) {
                actualizarContrasena($token, $usuario);
                $cambio_contrasena_exitoso = true;
                echo "<script>
                        setTimeout(function() {
                            window.location.href = 'listado.php';
                        }, 2500);
                    </script>";
            }
        }
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="css/estilo.css">
</head>
<body>
    <?php if(isset($cambio_contrasena_exitoso) && $cambio_contrasena_exitoso): ?>
        <span class="exito"> Contraseña cambiada con éxito </span>
    <?php endif; ?>
    <!-- formulario para recuperar contraseña -->
    <form action="procesar.php" method="post">
        <label for="nueva_contrasena">Nueva contraseña:</label> <br>
        <input type="text" name="nueva_contrasena">
        <?php if (isset($errores["nueva_contrasena"])): ?>
            <span class="error"><?= $errores["nueva_contrasena"] ?></span>
        <?php endif; ?> <br>

        <input type="submit" value="Enviar">
    </form>

</body>
</html>