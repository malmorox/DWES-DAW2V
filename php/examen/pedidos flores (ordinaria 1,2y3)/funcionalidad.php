<?php

    session_start();

    define ("DB_DATA", "mysql:host=localhost;dbname=examen");
    define ("USERNAME", "examen");
    define ("PASSWORD" , "examen");
    
    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    function obtenerFlores() {
        global $db;

        $consulta = $db->prepare("SELECT * FROM flores");
        $consulta->execute();
        $flores = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $flores;
    }

    function obtenerFlorPorId($id) {
        global $db;

        $consulta = $db->prepare("SELECT * FROM flores WHERE id = :id");
        $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        $flor = $consulta->fetch(PDO::FETCH_ASSOC);
        
        return $flor;
    }

    function insertarPedido($flor_id, $fecha, $cantidad) {
        global $db;

        $consulta = $db->prepare("INSERT INTO pedidos (flor_id, direccion, fecha, unidades) VALUES (:flor_id, 'Calle error', :fecha, :cantidad)");
        $consulta->bindParam(":flor_id", $flor_id, PDO::PARAM_INT);
        $consulta->bindParam(":fecha", $fecha);
        $consulta->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $consulta->execute();
    }

    function actualizarStock($flor_id, $cantidad) {
        global $db;

        $consulta = $db->prepare("UPDATE flores SET stock = stock - :cantidad WHERE id = :id");
        $consulta->bindParam(":cantidad", $cantidad, PDO::PARAM_INT);
        $consulta->bindParam(":id", $flor_id, PDO::PARAM_INT);
        $consulta->execute();
    }

    function contarPedidos() {
        global $db;

        $consulta = $db->prepare("SELECT COUNT(*) FROM pedidos");
        $consulta->execute();
        $total_pedidos = $consulta->fetchColumn();

        return $total_pedidos;
    }

    function obtenerPedidos($limit, $offset) {
        global $db;

        $consulta = $db->prepare("SELECT * FROM pedidos LIMIT :limit OFFSET :offset");
        $consulta->bindParam(':limit', $limit, PDO::PARAM_INT);
        $consulta->bindParam(':offset', $offset, PDO::PARAM_INT);
        $consulta->execute();
        $pedidos = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $pedidos;
    }

    function obtenerInfoUsuarioPorId($id) {
        global $db;

        $consulta = $db->prepare("SELECT * FROM usuarios WHERE id = :id");
        $consulta->bindParam(":id", $id, PDO::PARAM_INT);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return $usuario;
    }

    function obtenerTokens() {
        global $db;

        $consulta = $db->prepare("SELECT * FROM tokens");
        $consulta->execute();
        $tokens = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $tokens;
    }

    function validarToken($token) {
        global $db;

        $consulta = $db->prepare("SELECT * FROM tokens WHERE token = :token AND fecha_validez > NOW() AND consumido = 0");
        $consulta->bindParam(":token", $token);
        $consulta->execute();
        $token = $consulta->fetch(PDO::FETCH_ASSOC);

        return $token ? true : false;
    }

    function obtenerIdPorToken($token) {
        global $db;

        $consulta = $db->prepare("SELECT usuario_id FROM tokens WHERE token = :token");
        $consulta->bindParam(":token", $token);
        $consulta->execute();
        $id_usuario = $consulta->fetchColumn();

        return $id_usuario;
    }

    function validarNuevaContrasena($token, $contrasena) {
        global $db;

        $id_usuario = obtenerIdPorToken($token);

        $consulta_contra_actual_usuario = $db->prepare("SELECT pass FROM usuarios WHERE id = :id");
        $consulta_contra_actual_usuario->bindParam(":id", $id_usuario, PDO::PARAM_INT);
        $consulta_contra_actual_usuario->execute();
        $contra_actual_usuario = $consulta_contra_actual_usuario->fetchColumn();

        return ($contrasena === $contra_actual_usuario) ? true : false;
    }

    function actualizarContrasena($token, $contrasena) {
        global $db;

        $id_usuario = obtenerIdPorToken($token);
        $contrasena_hasheada = password_hash($contrasena, PASSWORD_DEFAULT);

        $consulta = $db->prepare("UPDATE usuarios SET pass = :contrasena WHERE id = :id");
        $consulta->bindParam(":contrasena", $contrasena_hasheada);
        $consulta->bindParam(":id", $id_usuario, PDO::PARAM_INT);
        $consulta->execute();
    }

    function consumirToken($token) {
        global $db;

        $consulta = $db->prepare("UPDATE tokens SET consumido = 1 WHERE token = :token");
        $consulta->bindParam(":token", $token);
        $consulta->execute();
    }
?>
