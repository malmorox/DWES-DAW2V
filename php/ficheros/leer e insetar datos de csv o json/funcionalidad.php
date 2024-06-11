<?php

    define('FICHERO_CSV', 'empleados.csv');
    define('FICHERO_JSON', 'empleados.json');

    function guardarEnCSV($empleado) {
        $empleadoCSV = implode(',', $empleado) . PHP_EOL;
        file_put_contents(FICHERO_CSV, $empleadoCSV, FILE_APPEND);
    }

    function guardarEnJSON($empleado) {
        $empleados = [];

        if (file_exists(FICHERO_JSON)) {
            $empleados = json_decode(file_get_contents(FICHERO_JSON), true);
        }

        $empleados[] = $empleado;
        file_put_contents(FICHERO_JSON, json_encode($empleados, JSON_PRETTY_PRINT));
    }

    function mostrarDesdeCSV() {
        if (file_exists(FICHERO_CSV)) {
            $archivo = fopen(FICHERO_CSV, 'r');
            if ($archivo) {
                while (($linea = fgets($archivo)) !== false) {
                    $valores = explode(',', $linea);
                    echo "<tr>";
                    foreach ($valores as $valor) {
                        echo "<td> $valor </td>";
                    }
                    echo "</tr>";
                }
                fclose($archivo);
            }
        }
    }

    function mostrarDesdeJSON() {
        if (file_exists(FICHERO_JSON)) {
            $empleados = json_decode(file_get_contents(FICHERO_JSON), true);
            foreach ($empleados as $empleado) {
                /*echo "<tr>";
                echo "<td>{$empleado['mote']}</td>";
                echo "<td>{$empleado['nombre']}</td>";
                echo "<td>{$empleado['departamento']}</td>";
                echo "</tr>";*/
                echo "<tr>";
                foreach ($empleado as $valor) {
                    echo "<td> {$valor} </td>";
                }
                echo "</tr>";
            }
        }
    }

?>