<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Recuperar la contraseña </title>
</head>
<body>
    <h2> Restablece tu contraseña </h2>
    <form action="reset_password_process.php" method="post">
        <input type="hidden" name="token" value="<?php echo $_GET['token']; ?>">

        <label for="nueva_contrasena"> Nueva contraseña: </label> <br>
        <input type="password" name="nueva_contrasena"> <br>

        <label for="confirmar_nueva_contrasena"> Confirma la contraseña: </label> <br>
        <input type="password" name="confirmar_nueva_contrasena"><br>

        <input type="submit" name="resetear" value="RESTABLECER">
    </form>
</body>
</html>