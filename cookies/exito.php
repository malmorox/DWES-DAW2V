<?php
    session_start();

    if(!isset($_SESSION['usuario'])) {
        header('Location: login.php');
        exit;
    }

    $usuario = $_SESSION['usuario'];
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Éxito</title>
</head>
<body>
    <h2>Bienvenido, <?php echo $usuario; ?></h2>
    <p>¡Ha iniciado sesión con éxito!</p>
</html>