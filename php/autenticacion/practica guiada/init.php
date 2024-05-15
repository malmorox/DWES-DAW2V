<?php 

    require_once 'funcionalidad.php';

    define('DOC_ROOT', dirname(__FILE__) . '/');
    define('TIEMPO_EXPIRACION_RECUERDAME', 7 * 24 * 60 * 60);

    spl_autoload_register(function ($clase) {
        require DOC_ROOT . $clase . '.php';
    });

    $db = DWESBaseDatos::obtenerInstancia();
    $db->inicializa(
        'practicando',
        'malmorox',
        '1234');

    session_start();

?>