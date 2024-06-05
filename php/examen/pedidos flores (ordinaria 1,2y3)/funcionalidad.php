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

    function obtenerPedidos() {
        global $db;

        $consulta = $db->prepare("SELECT * FROM pedidos");
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

        $consulta = $db->prepare("SELECT * FROM tokens WHERE token = :token");
        $consulta->bindParam(":token", $token);
        $consulta->execute();
        $token = $consulta->fetch(PDO::FETCH_ASSOC);

        return $token ? true : false;
    }

    function validarNuevaContrasena($contrasena) {
        global $db;

        $consulta = $db->prepare("SELECT * FROM usuarios WHERE contrasena = :contrasena");
        $consulta->bindParam(":contrasena", $contrasena);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        return $usuario ? false : true;
    }

    function actualizarContrasena($token, $contrasena) {
        global $db;

        $consulta = $db->prepare("UPDATE usuarios SET contrasena = :contrasena WHERE token = :token");
        $consulta->bindParam(":contrasena", $contrasena);
        $consulta->bindParam(":token", $token);
        $consulta->execute();
    }
?>
