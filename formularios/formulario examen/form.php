<?php
    require 'conexion.php';

    $errors = [];

    $query = "SELECT nombre FROM generos_musicales";
    $todos_generos = queryBaseDatos($query);

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (empty($_POST['nombre'])) {
            $errors['nombre'] = "El nombre es obligatorio.";
        }

        if (empty($_POST['direccion'])) {
            $errors['direccion'] = "La dirección es obligatoria.";
        }

        if (empty($_POST['suscripcion'])) {
            $errors['suscripcion'] = "Debes seleccionar un tipo de suscripción.";
        }

        if (empty($_POST['generos']) || count($_POST['generos']) == 0) {
            $errors['generos'] = "Debes seleccionar al menos un género.";
        }

        if (empty($errors)) {
            // Procesar el formulario aquí (guardar en la base de datos, etc.)
            // Redirigir a la página de éxito
            header('Location: pagina_exito.php');
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Formularios de pedidos </title>
</head>
<body>
    <h5> Formulario de pedidos </h5>
    <form action="" method="post">
        <label for="nombre"> Nombre: </label>
        <input type="text" name="nombre" value="<?php echo isset($_POST['nombre']) ? htmlspecialchars($_POST['nombre']) : ''; ?>">
        <?php if (isset($errors['nombre'])): ?>
            <span style="color: red;"><?php echo $errors['nombre']; ?></span>
        <?php endif; ?> <br>
        <label for="direccion"> Dirección: </label>
        <input type="text" name="direccion" value="<?php echo isset($_POST['direccion']) ? htmlspecialchars($_POST['direccion']) : ''; ?>">
        <?php if (isset($errors['direccion'])): ?>
            <span style="color: red;"><?php echo $errors['direccion']; ?></span>
        <?php endif; ?> <br>
        <label for="suscripcion"> Tipo de suscripcion: </label>
        <select name="suscripcion">
            <option value="" disabled selected>Selecciona una opción</option>
            <option value="mensual" <?php echo (isset($_POST['suscripcion']) && $_POST['suscripcion'] == 'mensual') ? 'selected' : ''; ?>>Mensual</option>
            <option value="trimestral" <?php echo (isset($_POST['suscripcion']) && $_POST['suscripcion'] == 'trimestral') ? 'selected' : ''; ?>>Trimestral</option>
        </select>
        <?php if (isset($errors['suscripcion'])): ?>
            <span style="color: red;"><?php echo $errors['suscripcion']; ?></span>
        <?php endif; ?> <br>
        <label for="genero"> Generos: </label>
        <?php foreach($todos_generos as $genero) { ?>
            <span><input type="checkbox" name="generos[]" value="<?php echo htmlspecialchars($genero['nombre']); ?>" <?php echo (isset($_POST['generos']) && in_array($genero['nombre'], $_POST['generos'])) ? 'checked' : '' ?>> <?php echo $genero ?> </span>
        <?php } ?> <br>
        <?php if (isset($errors['generos'])): ?>
            <span style="color: red;"><?php echo $errors['generos']; ?></span>
        <?php endif; ?> <br>
        <input type="submit" name="enviar">
    </form>
</body>
</html>