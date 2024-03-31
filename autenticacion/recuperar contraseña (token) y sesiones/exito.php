<?php
    session_start();

    // Verificamos si el usuario está autenticado
    if (!isset($_SESSION["loggeado"]) || $_SESSION["loggeado"] !== true) {
        header("Location: login.php");
        exit;
    }

    $usuario = $_SESSION["usuario"];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito</title>
</head>
<body>
    <h2> ¡Bienvenido! </h2>
    <p> Hola, <?php echo $usuario; ?>. Has iniciado sesión con éxito. </p>
    
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>