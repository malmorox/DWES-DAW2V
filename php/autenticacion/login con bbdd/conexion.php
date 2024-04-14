<?php
    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "1234");
    

    function iniciarSesion($usuario, $contrasena) {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $consulta = $db->prepare("SELECT * FROM usuarios WHERE usuario = :usuario");
        $consulta->bindValue(':usuario', $usuario, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);
    
        if ($usuario && password_verify($contrasena, $usuario['contrasena'])) {
            return true;
        }
    
        return false;
    }
?>