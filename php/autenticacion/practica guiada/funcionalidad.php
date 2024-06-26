<?php

    function generarToken() {
        return bin2hex(openssl_random_pseudo_bytes(64));
    }

    function guardarToken($token, $id_usuario, $expiracion, $consumido) {
        global $db;

        $db->ejecuta("INSERT INTO tokens (token, usuario_id, fecha_validez, consumido) VALUES (:token, :id, :expira, :consumido)", $token, $id_usuario, $expiracion, $consumido);
    }

    function buscarIdUsuarioPorToken($token) {
        global $db;
    
        $id_usuario = $db->ejecuta("SELECT usuario_id FROM tokens WHERE token = :token AND fecha_validez > :fecha", $token, date('Y-m-d H:i:s'));
        $id_usuario = $db->obtenColumna();
    
        if (empty($id_usuario)) {
            return null;
        }
    
        return $id_usuario;
    }

    function obtenerNombreUsuario($id_usuario) {
        global $db;

        $nombre_usuario = $db->ejecuta("SELECT nombre FROM usuarios WHERE id = :id", $id_usuario);
        $nombre_usuario = $db->obtenColumna();

        if (empty($nombre_usuario)) {
            return null;
        }

        return $nombre_usuario;
    }

    function marcarTokenConsumido($token) {
        global $db;

        $db->ejecuta("UPDATE tokens SET consumido = 1 WHERE token = :token AND consumido = 0", $token);
    }

?>