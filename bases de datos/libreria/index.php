<?php
    include_once 'conexion.php';

    $errores_telefono = [];
    $errores_prestamo = [];


    $libros = listadoLibros();
    $clientes = listadoClientes();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if (isset($_POST['telefono_submit'])) {
            if (empty($_POST['cliente_telefono'])) {
                $errores_telefono['cliente'] = "Debes seleccionar un cliente";
            }

            $telefono = $_POST['nuevo_telefono'];
            if (empty($telefono)) {
                $errores_telefono['telefono'] = "Debes ingresar un numero de telefono";
            } elseif (!preg_match("/^[0-9]{9}$/", $telefono)) {
                $errores_telefono['telefono'] = "El numero de telefono debe contener 9 digitos";
            }
            
            if (empty($errores_telefono)) {
                $cliente_seleccionado = $_POST['cliente_telefono'];

                $modificacion_exitosa = actualizarTelefonoCliente($telefono, $cliente_seleccionado);

                if ($modificacion_exitosa) {
                    echo "El telefono se ha actualizado correctamente";
                } else {
                    echo "Error al actualizar el telefono";
                }
            }
        } elseif (isset($_POST['prestamo_submit'])) {
            if (empty($_POST['libro'])) {
                $errores_prestamo['libro'] = "Debes seleccionar un libro";
            }

            if (empty($_POST['cliente_prestamo'])) {
                $errores_prestamo['cliente'] = "Debes seleccionar un cliente";
            }

            if (empty($_POST['fecha'])) {
                $errores_prestamo['fecha'] = "Debes ingresar la fecha del prestamo";
            }

            if (empty($errores_prestamo)) {
                
            }
        }
    }
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Libreria </title>
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
    <form method="post" action="form.php">
        <label for="cliente_telefono"> Cliente: </label>
        <select name="cliente_telefono">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($clientes as $cliente): ?>
                <option <?= isset($_POST['cliente']) && $_POST['cliente'] == $cliente['nombre'] ? 'selected' : '' ?>><?= $cliente['nombre']; ?></option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores['cliente'])): ?>
            <span class="error"><?= $errores['cliente']; ?></span>
        <?php endif; ?> <br> <br>

        <label for="nuevo_telefono"> Nuevo telefono: </label> 
        <input type="text" pattern="[0-9]{9}" name="nuevo_telefono"> <br>
        <?php if (isset($errores['telefono'])): ?>
            <span class="error"><?= $errores['telefono']; ?></span>
        <?php endif; ?> <br> <br>

        <input type="submit" name="telefono_submit" value="MODIFICAR CONTRASEÑA">
    </form>
    <h2> Insertar un nuevo préstamo </h2>
    <form method="post" action="form.php">        
        <label for="libro"> Libro: </label> <br>
        <select name="libro">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($libros as $libro): ?>
                <option><?= $libro['titulo']; ?></option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores['libro'])): ?>
            <span class="error"><?= $errores['libro']; ?></span><br>
        <?php endif; ?> <br> <br>

        <label for="cliente_prestamo"> Cliente: </label> <br>
        <select name="cliente_prestamo">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($clientes as $cliente): ?>
                <option><?= $cliente['nombre']; ?></option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores['cliente'])): ?>
            <span class="error"><?= $errores['cliente']; ?></span><br>
        <?php endif; ?> <br> <br>

        <label for="fecha"> Fecha del prestamo: </label> <br>
        <input type="date" name="fecha"> <br>
        <?php if (isset($errores['fecha'])): ?>
            <span class="error"><?= $errores['fecha']; ?></span><br>
        <?php endif; ?> <br> <br>
        
        <input type="submit" name="prestamo_submit" value="PRESTAR">
    </form>
</body>
</html>