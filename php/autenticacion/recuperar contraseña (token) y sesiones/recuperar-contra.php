<?php
require_once "conexion.php";

$errores = [];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST["email"];

    $usuario = buscarUsuarioPorEmail($email);

    if ($usuario) {
        $token = generarToken();

        insertarTokenUsuario($email, $token);

        header("Location: reset.php?token=" . urlencode($token));
        exit;
    } else {
        $errores['email'] = "El correo electrónico proporcionado no está asociado a ninguna cuenta.";
    }
}

function generarToken() {
    return bin2hex(openssl_random_pseudo_bytes(16));
}

?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar contraseña</title>
</head>
<body>
    <h2>Recuperar contraseña</h2>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
        <label for="email">Correo electrónico:</label>
        <input type="email" id="email" name="email" required>
        
        <?php if (isset($errores['email'])): ?>
            <span style="color: red;"><?php echo $errores['email']; ?></span><br>
        <?php endif; ?>

        <input type="submit" value="RECUPERAR CONTRASEÑA">
    </form>
</body>
</html>