<?php

    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "1234");
    
    try {
        $db = new PDO(DB_DATA, USERNAME, PASSWORD);
    }catch(PDOException $e){
        echo "ERROR:" . $e->getMessage();
        die();
    }

?>    