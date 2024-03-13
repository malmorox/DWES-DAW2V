<?php
    include 'procesar.php';

    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "marcos1234");
    

    function iniciarSesion($nombre, $pass) {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $consulta = $db->prepare("select * from usuarios where nombre = :nombre");
        $consulta->bindValue(':nombre', $nombre, PDO::PARAM_STR);
        $consulta->execute();
        $usuario = $consulta->fetch(PDO::FETCH_ASSOC);

        if (password_verify($pass, $usuario['pass'])) {
            return true;
        }
        $errors['usuariomalo'] = 'Credenciales incorrectas';
        return false;
    }
?>