<?php

    session_start();

    define("NUMERO_DE_TOKENS_A_CREAR_AL_CONSUMIR_UN_TOKEN", 5);
    define("NUMERO_DE_CARACTERES_TOKEN", 10);

    define ("DB_DATA", "mysql:host=localhost;dbname=examen");
    define ("USERNAME", "examen");
    define ("PASSWORD" , "examen");
    
    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

    function obtenerTokens() {
        global $db;
        $consulta = $db->prepare("SELECT * FROM auth_tokens");
        $consulta->execute();
        $tokens = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $tokens;
    }

    function obtenerDatosTokenProporcionado($token) {
        global $db;
        $consulta = $db->prepare("SELECT * FROM auth_tokens WHERE token = :token");
        $consulta->bindParam(":token", $token);
        $consulta->execute();
        $datos_token = $consulta->fetch(PDO::FETCH_ASSOC);

        return $datos_token;
    }

    function obtenerEmailUsuarioTokenProporcionado($id_usuario_conmsumidor_token) {
        global $db;
        $consulta = $db->prepare("SELECT email FROM usuarios WHERE id = :id");
        $consulta->bindParam(":id", $id_usuario_conmsumidor_token, PDO::PARAM_INT);
        $consulta->execute();
        $email_usuario = $consulta->fetchColumn();

        return $email_usuario;
    }

    function registrarUsuario($email) {
        global $db;
        $consulta = $db->prepare("INSERT INTO usuarios (email) VALUES (:email)");
        $consulta->bindParam(":email", $email);
        $consulta->execute();
    }

    function obtenerIdUsuarioAtravesEmailProporcionado($email) {
        global $db;
        $consulta = $db->prepare("SELECT id FROM usuarios WHERE email = :email");
        $consulta->bindParam(":email", $email);
        $consulta->execute();
        $id_usuario = $consulta->fetchColumn();

        return $id_usuario;
    }

    function consumirToken($id_token, $id_usuario_generador_token) {
        global $db;
        $consulta = $db->prepare("UPDATE auth_tokens SET consumido = 1, id_user_consumido = :id_user_consumido WHERE id = :id");
        $consulta->bindParam(":id_user_consumido", $id_usuario_generador_token, PDO::PARAM_INT);
        $consulta->bindParam(":id", $id_token, PDO::PARAM_INT);
        $consulta->execute();
    }

    function insertarTokens($token, $id_usuario_generador_token) {
        global $db;
        $consulta = $db->prepare("INSERT INTO auth_tokens (token, id_user_generador, id_user_consumido, consumido) VALUES (:token, :id_user_generador, null, 0)");
        $consulta->bindParam(":token", $token);
        $consulta->bindParam(":id_user_generador", $id_usuario_generador_token, PDO::PARAM_INT);
        $consulta->execute();
    }

?>