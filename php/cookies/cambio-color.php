<?php
    if(isset($_POST['color'])) {
        $color = $_POST['color'];
        
        setcookie('color_fondo', $color, time() + (3600 * 24 * 7), "/");
        
        header('Location: ' . $_SERVER['PHP_SELF']);
        exit;
    }

    if(isset($_COOKIE['color_fondo'])) {
        $color = $_COOKIE['color_fondo'];
    } else {
        $color = 'claro';
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Selector de Color de Fondo</title>
    <style>
        body {
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
            <?php if($color === 'oscuro'): ?>
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
            <?php if($color === 'oscuro'): ?>
                background-color: #ffffff;
                color: #333333;
            <?php else: ?>
                background-color: #333333;
                color: #ffffff;
            <?php endif; ?>    
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .contenedor h2 {
            margin-top: 0;
        }
    </style>
</head>
<body>
    <div class="contenedor">
        <h2> Selector de color de fondo </h2>
        <form method="post">
            <label><input type="radio" name="color" value="claro" <?php if($color === 'claro') echo 'checked'; ?>> Claro</label>
            <label><input type="radio" name="color" value="oscuro" <?php if($color === 'oscuro') echo 'checked'; ?>> Oscuro</label>
            <button type="submit">Guardar Preferencia</button>
        </form>
    </div>
</body>
</html>