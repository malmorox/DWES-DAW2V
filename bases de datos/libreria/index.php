<?php
    include_once 'conexion.php';

    $errores_telefono = [];
    $errores_prestamo = [];


    $todos_libros = listadoLibros();
    $libros_despues_2000 = listadoLibros(2000);
    $todos_clientes = listadoClientes();

    if ($_SERVER["REQUEST_METHOD"] == "POST") { 
        if (isset($_POST['telefono_submit'])) {
            if (empty($_POST['cliente_telefono'])) {
                $errores_telefono['cliente'] = "Debes seleccionar un cliente";
            }

            $nuevo_telefono = intval($_POST['nuevo_telefono']);
            if (empty($nuevo_telefono)) {
                $errores_telefono['telefono'] = "Debes ingresar un numero de telefono";
            } elseif (!preg_match("/^[0-9]{9}$/", $nuevo_telefono)) {
                $errores_telefono['telefono'] = "El numero de telefono debe contener 9 digitos";
            }
            
            if (empty($errores_telefono)) {
                $cliente_seleccionado = $_POST['cliente_telefono'];

                $modificacion_exitosa = actualizarTelefonoCliente($nuevo_telefono, $cliente_seleccionado);
            }
        } elseif (isset($_POST['prestamo_submit'])) {
            // Hay que hacerlo de esta forma para verificar primero si esas claves existen antes de intentar acceder a ellas, sino da error al runnearlo
            $libro = isset($_POST['libro']) ? $_POST['libro'] : null;
            $cliente = isset($_POST['cliente_prestamo']) ? $_POST['cliente_prestamo'] : null;
            $fecha = isset($_POST['fecha']) ? $_POST['fecha'] : null;
            
            if (empty($libro)) {
                $errores_prestamo['libro'] = "Debes seleccionar un libro";
            }

            if (empty($cliente)) {
                $errores_prestamo['cliente'] = "Debes seleccionar un cliente";
            }

            if (empty($fecha)) {
                $errores_prestamo['fecha'] = "Debes ingresar la fecha del prestamo";
            }

            if (empty($errores_prestamo)) {
                $inserccion_prestamo = insertarPrestamo($libro, $cliente, $fecha);

                if ($inserccion_prestamo) {
                    $libro_prestamo = urlencode(obtenerNombrePorId('libros', $libro));
                    $cliente_prestamo = urlencode(obtenerNombrePorId('clientes', $cliente));
                    $fecha_prestamo = urlencode($fecha);

                    header("Location: exito.php?libro=$libro_prestamo&cliente=$cliente_prestamo&fecha=$fecha_prestamo");
                    exit();
                }
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
        .exito { color: #43CA57; }
        .error { color: red; }
    </style>
</head>
<body>
    <h2> Listado de todos los libros publicados después del año 2000 </h2>
    <ul>
        <?php foreach ($libros_despues_2000 as $libro): ?>
            <li><?= $libro['titulo']; ?></li>
        <?php endforeach; ?>
    </ul>
    <h2> Actualizar el número de teléfono de un cliente específico </h2>
    <?php if (isset($modificacion_exitosa) && $modificacion_exitosa): ?>
        <span class="exito"> El telefono se ha actualizado correctamente </span>
    <?php elseif(isset($modificacion_exitosa)): ?>
        <span class="error"> Error al actualizar el telefono </span>
    <?php endif; ?>
    <form method="post" action="index.php">
        <label for="cliente_telefono"> Cliente: </label>
        <select name="cliente_telefono">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($todos_clientes as $cliente): ?>
                <option value="<?= $cliente['id']; ?>" <?= isset($_POST['cliente_telefono']) && $_POST['cliente_telefono'] == $cliente['id'] ? 'selected' : '' ?>> <?= $cliente['nombre']; ?> </option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores_telefono['cliente'])): ?>
            <span class="error"> <?= $errores_telefono['cliente']; ?> </span>
        <?php endif; ?> <br>

        <label for="nuevo_telefono"> Nuevo telefono: </label> 
        <input type="text" name="nuevo_telefono" value="<?= isset($_POST['nuevo_telefono']) ? $_POST['nuevo_telefono'] : '' ?>" /*pattern="[0-9]{9}"*/> <br>
        <?php if (isset($errores_telefono['telefono'])): ?>
            <span class="error"> <?= $errores_telefono['telefono']; ?> </span>
        <?php endif; ?> <br>

        <input type="submit" name="telefono_submit" value="MODIFICAR CONTRASEÑA">
    </form>
    <h2> Insertar un nuevo préstamo </h2>
    <?php if (isset($inserccion_prestamo) && !$inserccion_prestamo): ?>
        <span class="error"> No se podido realizar el prestamo </span>
    <?php endif; ?>
    <form method="post" action="index.php">        
        <label for="libro"> Libro: </label> <br>
        <select name="libro">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($todos_libros as $libro): ?>
                <option value="<?= $libro['id']; ?>"  <?= isset($_POST['libro']) && $_POST['libro'] == $libro['id'] ? 'selected' : '' ?>> <?= $libro['titulo']; ?> </option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores_prestamo['libro'])): ?>
            <span class="error"> <?= $errores_prestamo['libro']; ?> </span><br>
        <?php endif; ?> <br>

        <label for="cliente_prestamo"> Cliente: </label> <br>
        <select name="cliente_prestamo">
            <option disabled selected> Selecciona una opción </option>
            <?php foreach ($todos_clientes as $cliente): ?>
                <option value="<?= $cliente['id']; ?>" <?= isset($_POST['cliente_prestamo']) && $_POST['cliente_prestamo'] == $cliente['id'] ? 'selected' : '' ?>> <?= $cliente['nombre']; ?> </option>
            <?php endforeach; ?>
        </select> <br>
        <?php if (isset($errores_prestamo['cliente'])): ?>
            <span class="error"> <?= $errores_prestamo['cliente']; ?> </span><br>
        <?php endif; ?> <br>

        <label for="fecha"> Fecha del prestamo: </label> <br>
        <input type="date" name="fecha" value="<?= isset($_POST['fecha']) ? $_POST['fecha'] : '' ?>"> <br>
        <?php if (isset($errores_prestamo['fecha'])): ?>
            <span class="error"> <?= $errores_prestamo['fecha']; ?> </span><br>
        <?php endif; ?> <br>
        
        <input type="submit" name="prestamo_submit" value="PRESTAR">
    </form>
</body>
</html>