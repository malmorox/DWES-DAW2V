<?php
session_start();

// Verificamos si el usuario está autenticado
if (!isset($_SESSION["loggedin"])) {
    header("Location: login.php");
    exit;
}
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
    <?php
        $usuario = isset($_GET['usuario']) ? htmlspecialchars($_GET['usuario']) : 'Usuario desconocido';
        echo "<p>Hola, $usuario. Has iniciado sesión con éxito.</p>";
    ?>
</body>
</html>