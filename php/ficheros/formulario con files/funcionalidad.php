<?php

    require_once 'conexion.php';

    function insertarAccion($fecha, $lugar, $nombre, $descripcion, $foto) {
        $insert = "INSERT INTO acciones (fecha, lugar, nombre, descripcion, foto) VALUES (:fecha, :lugar, :nombre, :descripcion, :foto)";
        $consulta = $db->prepare($insert);
        $consulta->bindParam(':fecha', $fecha);
        $consulta->bindParam(':lugar', $lugar);
        $consulta->bindParam(':nombre', $nombre);
        $consulta->bindParam(':descripcion', $descripcion);
        $consulta->bindParam(':foto', $foto);
        $consulta->execute();
    }

    function listadoAcciones($orden = null) {
        $select = "SELECT * FROM acciones";
        if ($orden === 'ascendente') {
            $select .= " ORDER BY fecha ASC";
        } elseif ($orden === 'descendente') {
            $select .= " ORDER BY fecha DESC";
        }
        $consulta = $db->prepare($select);
        $consulta->execute();
        $acciones = $consulta->fetchAll(PDO::FETCH_ASSOC);
    
        return $acciones;
    }

    function validarFoto($foto) {
        $directorio = "uploads/";

        if(isset($_FILES["imagen_perfil"])){
    
        $archivo = $directorio . basename($_FILES["imagen_perfil"]["name"]);
        $nombreArchivo = basename($_FILES["imagen_perfil"]["name"]);
        $formatoImagen = strtolower(pathinfo($archivo, PATHINFO_EXTENSION));
    
        // Verifica si es una imagen real o una imagen falsa
        $check = getimagesize($_FILES["imagen_perfil"]["tmp_name"]);
        if($check !== false) {
            $subir = 1;
        } else {
            echo "El archivo no es una imagen.";
            $subir = 0;
        }

    // Si el archivo ya existe, añadir un número al final
        $contador = 1;
        while (file_exists($archivo)) {
            $nombreSinExtension = pathinfo($nombreArchivo, PATHINFO_FILENAME);
            $archivo = $directorio . $nombreSinExtension . '-' . $contador . '.' . $formatoImagen;
            $contador++;
        }

        //TODO: Faltan verificaciones de tamaño y tipo.

        if ($subir == 1) {
            if (move_uploaded_file($_FILES["imagen_perfil"]["tmp_name"], $archivo)) {
                // Guardar la ruta de la imagen en la base de datos
                // TODO: 

                $sql = "UPDATE usuarios (perfil_img) VALUES (:path_imagen_perfil) WHERE id = :id_user";
                $consulta = $db->prepare($sql);
                $consulta->bindParam(":path_imagen_perfil", $archivo, PDO::PARAM_STR);
                $consulta->bindParam(":id", $id, PDO::PARAM_INT);
                $resultado = $consulta->execute();

                if($resultado){{
                    echo "La imagen ". basename($_FILES["imagen_perfil"]["name"]). " ha sido subida.";
                } else {
                    echo "Error al guardar la imagen en la base de datos: " . $conn->error;
                }
                
            } else {
                echo "Hubo un error al subir tu archivo.";
            }
        }
    }
    }}

?>