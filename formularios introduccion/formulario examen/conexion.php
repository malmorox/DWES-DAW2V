<?php
    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "1234");

    function queryBaseDatos($query) {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
        $consulta = $db->prepare($query);
        $consulta->execute();
        $resultado = $consulta->fetchAll(PDO::FETCH_ASSOC);
        
        return $resultado;
    }

?>