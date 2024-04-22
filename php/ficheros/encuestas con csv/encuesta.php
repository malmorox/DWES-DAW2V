<?php

    define('FICHERO_PREGUNTAS', 'preguntas.csv');
    define('FICHERO_RESPUESTAS', 'respuestas.csv');

    $errores = [];

    $preguntas = [];
    //Esto devuelve un puntero del archivo si se ha abierto correctamente o false si no
    $archivo_preguntas = fopen(FICHERO_PREGUNTAS, 'r');
    if ($archivo_preguntas !== false) {
        while (($linea = fgetcsv($archivo_preguntas)) !== false) {
            $preguntas[] = $linea[0];
        }
        fclose($archivo_preguntas);
    } else {
        $errores['preguntas'] = "Error al abrir el archivo de preguntas";
    }

    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['enviar'])) {
        $nombre = isset($_POST['nombre']) ? $_POST['nombre'] : null;
        if (empty($nombre)) {
            $errores['nombre'] = "Por favor, introduzca su nombre";
        }
        
        $respuestas = $_POST['respuestas'] ?? [];
        $pregunta_no_respondida = false;
    
        foreach ($preguntas as $indice => $pregunta) {
            if (!isset($respuestas[$indice]) || $respuestas[$indice] === "") {
                $pregunta_no_respondida = true;
                break;
            }
        }    

        if ($pregunta_no_respondida) {
            $errores['respuestas'] = "Por favor, responda a todas las preguntas";
        }

        if (empty($errores)) {
            $respuestas_csv = strtolower($nombre) . ';' . implode(';', $respuestas) . PHP_EOL;
            file_put_contents(FICHERO_RESPUESTAS, $respuestas_csv, FILE_APPEND);
            
            header("Location: exito.php");
            exit();
        }
    }

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title> Encuesta de satisfacción </title>
    <style>
        .error {color: red;}
    </style>
</head>
<body>
    <h1> Encuesta de satisfacción </h1>
    
    <form method="POST" action="encuesta.php">
        <label for="nombre"> Nombre: </label>
        <!-- Si la variable $nombre está definida y no es nula se imprimirá su valor. Si es nula se imprimirá '' -->
        <input type="text" name="nombre" value="<?= $nombre ?? '' ?>"> <br>
        <?php if (isset($errores['nombre'])): ?>
            <span class="error"> <?= $errores['nombre']; ?> </span>
        <?php endif; ?> <br>

        <?php foreach ($preguntas as $indice => $pregunta): ?>
            <h3> <?= $pregunta; ?> </h3>
            <?php
                $checked_nada = "";
                $checked_normal = "";
                $checked_mucho = "";

                if (isset($_POST['respuestas'][$indice])) {
                    $respuesta_seleccionada = $_POST['respuestas'][$indice];
                    if ($respuesta_seleccionada == "0") {
                        $checked_nada = "checked";
                    } elseif ($respuesta_seleccionada == "1") {
                        $checked_normal = "checked";
                    } elseif ($respuesta_seleccionada == "2") {
                        $checked_mucho = "checked";
                    }
                }
            ?>
            <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="0" <?php echo $checked_nada; ?>>
            <label for=""> Nada </label>
            <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="1" <?php echo $checked_normal; ?>>
            <label for=""> Normal </label>
            <input type="radio" name="respuestas[<?php echo $indice; ?>]" value="2" <?php echo $checked_mucho; ?>>
            <label for=""> Mucho </label> <br>
        <?php endforeach; ?>
        <?php if (isset($errores['respuestas'])): ?>
            <span class="error"> <?= $errores['respuestas']; ?> </span> <br>
        <?php endif; ?> <br>

        <input type="submit" name="enviar" value="Enviar">
    </form>
</body>
</html>
