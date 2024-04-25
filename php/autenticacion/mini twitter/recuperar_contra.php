<?php
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["enviar"])) {
        if (isset($_POST["correo"]) && !empty($_POST["correo"])) {
            // Aquí iría tu lógica de autenticación
            $correo_valido = true; // Simulando que se ha validado el correo
            
            if ($correo_valido) {
                // Si el correo es válido, enviar el correo de recuperación
                enviarCorreoRecuperacion($_POST["correo"]);
                echo "Se ha enviado un correo de recuperación a {$_POST['correo']}";
            } else {
                // Si el correo no es válido, mostrar un mensaje de error
                echo "El correo electrónico no es válido";
            }
        } else {
            // Si no se ha enviado un correo electrónico, mostrar un mensaje de error
            echo "Por favor ingresa un correo electrónico";
        }
    }
    
    // Función para enviar el correo de recuperación (ejemplo básico)
    function enviarCorreoRecuperacion($correo) {
        // Aquí iría tu lógica para enviar el correo de recuperación
        // Por ejemplo, utilizando PHPMailer
    }

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Recuperar contraseña </title>
    <link rel="stylesheet" href="css/estilos.css">
</head>
<body>
    <h2> Recupera tu contraseña</h2>
    <form action="recuperar_contra.php" method="post">
        <label for="correo"> Correo electrónico asociado a la cuenta: </label> <br>
        <input type="email" name="correo"> <br> <br>

        <input type="submit" name="enviar" value="ENVIAR CORREO">
    </form>
</body>
</html>