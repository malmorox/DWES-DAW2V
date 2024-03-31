<?php
    if(isset($_POST['submit'])) {
        setcookie('idioma', $_POST['idioma'], time() + (3600 * 24 * 7), "/");
        setcookie('tema_color', $_POST['tema_color'], time() + (3600 * 24 * 7), "/");
        setcookie('tamano_fuente', $_POST['tamano_fuente'], time() + (3600 * 24 * 7), "/");

        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }
    // Cargamos los textos según el idioma seleccionado
    $idioma_seleccionado = isset($_COOKIE['idioma']) ? $_COOKIE['idioma'] : 'es';
    $textos = json_decode(file_get_contents('preferencias.json'), true);
    $textos_idioma = $textos[$idioma_seleccionado];
?>

<!DOCTYPE html>
<html lang="<?php echo $idioma_seleccionado; ?>">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $textos_idioma['titulo']; ?></title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            <?php if(isset($_COOKIE['tema_color']) && $_COOKIE['tema_color'] === 'oscuro'): ?>
                background-color: #333333;
                color: #ffffff;
            <?php else: ?>
                background-color: #ffffff;
                color: #333333;
            <?php endif; ?>
        }
        .contenedor {
            max-width: 600px;
            margin: 50px auto;
            padding: 20px;
            <?php if(isset($_COOKIE['tema_color']) && $_COOKIE['tema_color'] === 'oscuro'): ?>
                background-color: #ffffff;
                color: #333333;
            <?php else: ?>
                background-color: #333333;
                color: #ffffff;
            <?php endif; ?>
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            <?php if(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'pequeno'): ?>
                font-size: 12px;
            <?php elseif(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'mediano'): ?>
                font-size: 18px;
            <?php elseif(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'grande'): ?>
                font-size: 24px;
            <?php endif; ?>
        }
        .contenedor h2 {
            margin-top: 0;
            <?php if(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'pequeno'): ?>
                font-size: 22px;
            <?php elseif(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'mediano'): ?>
                font-size: 28px;
            <?php elseif(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === 'grande'): ?>
                font-size: 34px;
            <?php endif; ?>
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2><?php echo $textos_idioma['titulo']; ?></h2>
        <p><?php echo $textos_idioma['bienvenida']; ?></p>
        <p><?php echo $textos_idioma['introduccion']; ?></p>
        <form method="post">
            <label for="idioma"><?php echo $textos_idioma['idioma']; ?></label>
            <select id="idioma" name="idioma">
                <?php foreach ($textos_idioma['opciones_idioma'] as $valor => $contenido): ?>
                    <option value="<?php echo $valor; ?>" <?php if($idioma_seleccionado === $valor) echo 'selected'; ?>><?php echo $contenido; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="tema_color"><?php echo $textos_idioma['tema_color']; ?></label>
            <select id="tema_color" name="tema_color">
                <?php foreach ($textos_idioma['opciones_tema_color'] as $valor => $contenido): ?>
                    <option value="<?php echo $valor; ?>" <?php if(isset($_COOKIE['tema_color']) && $_COOKIE['tema_color'] === $valor) echo 'selected'; ?>><?php echo $contenido; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <label for="tamano_fuente"><?php echo $textos_idioma['tamano_fuente']; ?></label>
            <select id="tamano_fuente" name="tamano_fuente">
                <?php foreach ($textos_idioma['opciones_tamano_fuente'] as $valor => $contenido): ?>
                    <option value="<?php echo $valor; ?>" <?php if(isset($_COOKIE['tamano_fuente']) && $_COOKIE['tamano_fuente'] === $valor) echo 'selected'; ?>><?php echo $contenido; ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <button type="submit" name="submit"><?php echo $textos_idioma['guardar']; ?></button>
        </form>
    </div>
</body>
</html>