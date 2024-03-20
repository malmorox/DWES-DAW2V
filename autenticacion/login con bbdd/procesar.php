<?php
include 'conexion.php';

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