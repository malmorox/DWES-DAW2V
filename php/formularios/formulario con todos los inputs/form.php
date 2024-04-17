<?php
    $errores = [];

    $alergias = [
        'Gluten',
        'Pescado',
        'Marisco',
        'Lactosa'
    ];

    $turnos = [
        'Mañana',
        'Tarde',
        'Noche'
    ];

    define('USUARIO', 'sergio');
    define('CONTRASENA', '1234');

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        $contrasena = isset($_POST['contrasena']) ? $_POST['contrasena'] : null;
        $comidas = isset($_POST['comidas']) ? $_POST['comidas'] : null;
        $turnoSeleccionado = isset($_POST['turnos']) ? $_POST['turnos'] : null;

        if (empty($nombre)) {
            $errores['nombre'] = "El nombre de usuario esta vacio";
        } elseif ($nombre !== USUARIO) {
            $errores['nombre'] = "El nombre de usuario no es correcto";
        }

        if (empty($contrasena)) {
            $errores['contrasena'] = "La contraseña esta vacia";
        } elseif ($contrasena !== CONTRASENA) {
            $errores['contrasena'] = "La contraseña no es correcta";
        }

        if (empty($errores)) {
            $nombre = urlencode($nombre);
            header('Location: exito.php?nombre=' . $nombre);
            die();
        }
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formulario repaso </title>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <h1> Inicio de sesión basiquito </h1>
    <form action="form.php" method="post">
        <label for="nombre"> Nombre de usuario: </label> <br>
        <input type="text" name="nombre" value="<?= $nombre ?>"> <br>
        <?php if (isset($errores['nombre'])): ?>
            <span class="error"> <?= $errores['nombre'] ?> </span>
        <?php endif; ?> <br>   

        <label for="contrasena"> Constraseña: </label> <br>
        <input type="password" name="contrasena" value="<?= $contrasena ?>"> <br>
        <?php if (isset($errores['contrasena'])): ?>
            <span class="error"> <?= $errores['contrasena'] ?> </span>
        <?php endif; ?> <br>
        
        <label for="comidas"></label>
        <select name="comidas">
            <option disabled selected> Selecciona una opcion </option>
            <option value="tomate" <?= ($comidas === 'tomate') ? 'selected' : '' ?>> Tomate </option>
            <option value="patata" <?= ($comidas === 'patata') ? 'selected' : '' ?>> Patata </option>
            <option value="cebolla" <?= ($comidas === 'cebolla') ? 'selected' : '' ?>> Cebolla </option>
        </select> <br> <br>
        
        <label for="alergias"> Alergias: </label> <br>
        <?php foreach ($alergias as $alergia): ?>
            <input type="checkbox" name="alergias[]" value="<?= $alergia ?>" <?= (isset($_POST['alergias']) && in_array($alergia, $_POST['alergias'])) ? 'checked' : '' ?>> <?= $alergia ?><br>
        <?php endforeach; ?> <br>
        <!--
        <input type="checkbox" name="alergias[]" value="gluten" <?//= (isset($_POST['alergias']) && in_array("gluten", $_POST['alergias'])) ? 'checked' : '' ?>> Gluten <br>
        <input type="checkbox" name="alergias[]" value="pescao" <?//= (isset($_POST['alergias']) && in_array("pescao", $_POST['alergias'])) ? 'checked' : '' ?>> Pescao <br>
        <input type="checkbox" name="alergias[]" value="marisco" <?//= (isset($_POST['alergias']) && in_array("marisco", $_POST['alergias'])) ? 'checked' : '' ?>> Marisco <br>
        <input type="checkbox" name="alergias[]" value="lactosa" <?//= (isset($_POST['alergias']) && in_array("lactosa", $_POST['alergias'])) ? 'checked' : '' ?>> Lactosa <br> <br>
        -->
        <label for="turnos"> Horario (turno): </label> <br>
        <?php foreach ($turnos as $turno): ?>
            <input type="radio" name="turnos" value="<?= $turno ?>" <?= ($turno === $turnoSeleccionado) ? 'checked' : '' ?>> <?= $turno ?><br>
        <?php endforeach; ?> <br> 
        <!--
        <input type="radio" name="turnos" value="manana" <?//= ($turnos === 'manana') ? 'checked' : '' ?>> Mañana
        <input type="radio" name="turnos" value="tarde" <?//= ($turnos === 'tarde') ? 'checked' : '' ?>> Tarde
        <input type="radio" name="turnos" value="noche" <?//= ($turnos === 'noche') ? 'checked' : '' ?>> Noche
        -->   
        <input type="submit" name="enviar" value="Iniciar sesión">
    </form>
</body>
</html>