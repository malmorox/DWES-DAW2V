<?php
    define ("DB_DATA", "mysql:host=localhost;dbname=practicando");
    define ("USERNAME", "malmorox");
    define ("PASSWORD" , "1234");
    
    function conexion() {
        try {
            $db = new PDO(DB_DATA, USERNAME, PASSWORD);
            return $db;
        } catch (PDOException $e) {
            echo $e->getMessage();
            return false;
        }
    }

    function listadoLibros($ano = null) {
        $db = conexion();
        if ($ano !== null) {
            $consulta = $db->prepare("SELECT * FROM libros WHERE ano_publicacion > :ano");
            $consulta->bindParam(':ano', $ano);
        } else {
            $consulta = $db->prepare("SELECT * FROM libros");
        }
        $consulta->execute();
        $libros = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        return $libros;
    }

    function listadoClientes() {
        $db = conexion();
        $consulta = $db->prepare("SELECT * FROM clientes");
        $consulta->execute();
        $clientes = $consulta->fetchAll(PDO::FETCH_ASSOC);

        return $clientes;
    }

    // Función para obtener el nombre de un libro o cliente con el ID que le pasemos y el nombre de la tabla de la BBDD
    function obtenerNombrePorId($tabla, $id) {
        $campo = ($tabla == 'libros') ? 'titulo' : 'nombre';

        $db = conexion();
        $consulta = $db->prepare("SELECT $campo FROM $tabla WHERE id = :id");
        $consulta->bindParam(':id', $id);
        $consulta->execute();
        $resultado = $consulta->fetch(PDO::FETCH_ASSOC);
    
        if ($resultado) {
            return $resultado[$campo];
        } else {
            return "ERROR";
        }
    }

    function actualizarTelefonoCliente($nuevotelefono, $idcliente) {
        $db = conexion();
        $consulta = $db->prepare("UPDATE clientes SET telefono = :nuevoTelefono WHERE id = :idCliente");
        $consulta->bindParam(':nuevoTelefono', $nuevoTelefono, PDO::PARAM_STR);
        $consulta->bindParam(':idCliente', $idCliente, PDO::PARAM_INT);
        $resultado = $consulta->execute();
        // Retorna true si hace el update y false si no lo hace
        return $resultado;
    }

    function insertarPrestamo($idlibro, $idcliente, $fechaprestamo) {
        $db = conexion();
        $consulta = $db->prepare("INSERT INTO prestamos (id_libro, id_cliente, fecha_prestamo) VALUES (:idlibro, :idcliente, :fechaprestamo)");
        $consulta->bindParam(':idlibro', $idlibro);
        $consulta->bindParam(':idcliente', $idcliente);
        $consulta->bindParam(':fechaprestamo', $fechaprestamo);   
        $resultado = $consulta->execute();

        return $resultado;
    }
?>