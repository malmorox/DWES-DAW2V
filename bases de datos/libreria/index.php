<?php
    include_once 'procesar.php';

    $errores = [];

    $libros = listadoLibros();
    $clientes = listadoClientes();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 


    
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if ($_POST['libro'] !== 'Marcos') {
            $errores['libro'] = "Debes seleccionar un libro.";
        }

        if ($_POST['cliente'] !== '1234') {
            $errores['cliente'] = "Debes selecionar el cliente que hará el prestamo.";
        }

        if ($_POST['fecha'] !== '1234') {
            $errores['fecha'] = "La fecha debe ser .";
        }

    
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Libreria</title>
    <style>
        .error { color: red; }
    </style>
</head>
<body>
    <h2> Listado de todos los libros publicados después del año 2000 </h2>
    <ul>
        <?php foreach ($libros as $libro): ?>
            <li><?= $libro['titulo']; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2> Actualizar el número de teléfono de un cliente específico </h2>
    <form action="">
        <label for=""> Cliente: </label>
        <select name="" id="">
            <?php foreach ($clientes as $cliente): ?>
                <option><?= $cliente['nombre']; ?></option>
            <?php endforeach; ?>
        </select>

        <label for=""> Nueva contraseña: </label> 
        <input type="text" name="nueva-contrasena"> <br>

        <input type="submit" value="MODIFICAR CONTRASEÑA">
    </form>
    <h2> Insertar un nuevo préstamo </h2>
    <form method="post" action="form.php">        
        <label for="libro"> Libro: </label> <br>
        <select name="libro" id="libro">
            <?php foreach ($libros as $libro): ?>
                <option><?= $libro['titulo']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['libro'])): ?>
            <span class="error"><?= $errores['libro']; ?></span><br>
        <?php endif; ?>

        <label for="cliente"> Cliente: </label> <br>
        <select name="cliente" id="cliente">
            <?php foreach ($clientes as $cliente): ?>
                <option><?= $cliente['nombre']; ?></option>
            <?php endforeach; ?>
        </select>
        <?php if (isset($errores['cliente'])): ?>
            <span class="error"><?= $errores['cliente']; ?></span><br>
        <?php endif; ?>

        <label for="fecha"> Fecha del prestamo: </label> <br>
        <input type="date" id="fecha" name="fecha"><br>
        <?php if (isset($errores['fecha'])): ?>
            <span class="error"><?= $errores['fecha']; ?></span><br>
        <?php endif; ?>
        
        <input type="submit" value="PRESTAR">
    </form>
</body>
</html>