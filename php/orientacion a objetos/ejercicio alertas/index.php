<?php

define('NUMERO_ALERTAS_ALEATORIAS', 10);

spl_autoload_register(function ($nombre_clase) {
    $directorio_clases = 'clases/';
    $archivo_clase = $directorio_clases . $nombre_clase . '.php';
    
    if (file_exists($archivo_clase)) {
        include $archivo_clase;
    }
});

$tipos_alerta = ['AlertaWarning', 'AlertaError', 'AlertaAlarma'];

for ($i = 0; $i < NUMERO_ALERTAS_ALEATORIAS; $i++) {
    $tipo = $tipos_alerta[array_rand($tipos_alerta)];
    $titulo = "Título de la alerta nº" . ($i + 1);
    $mensaje = "Mensaje de la alerta nº" . ($i + 1);
    
    $alerta = new $tipo($titulo, $mensaje);
    $alerta->mostrar();
}

?>
