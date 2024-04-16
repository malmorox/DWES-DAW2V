<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Perfil de Usuario</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>Bienvenido, <?php echo $usuario['nombre_usuario']; ?>!</h1>
    <h2>Editar Perfil</h2>
    <form action="update_profile.php" method="post">
        <label for="new_username">Nuevo Nombre de Usuario:</label>
        <input type="text" id="new_username" name="new_username" required>
        <input type="submit" value="Guardar Cambios">
    </form>
    <a href="logout.php">Cerrar sesión</a>
</body>
</html>