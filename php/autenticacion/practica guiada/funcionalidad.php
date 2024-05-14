<?php

    function generarToken() {
        return bin2hex(openssl_random_pseudo_bytes(128));
    }

    function guardarToken($token, $expiracion, $id_usuario) {
        global $db;

        $db->ejecuta("INSERT INTO tokens (token, id_usuario, fecha_validez) VALUES (:token, :id, :expira)", $token, $expiracion, $id_usuario);
    }

?>