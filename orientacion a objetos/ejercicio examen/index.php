<?php

// Definición de la clase OVNI abstracta
abstract class OVNI {
    protected $velocidad;
    protected $camuflaje;
    
    // Método abstracto pintarHTML
    abstract public function pintarHTML();

    // Método abstracto cargarInfo
    abstract public function cargarInfo($info);
}

// Subclase DiscoVolador que extiende de OVNI
class DiscoVolador extends OVNI {
    private $radio;

    public function pintarHTML() {
        return "<p>Disco Volador</p>";
    }

    public function cargarInfo($info) {
        // Suponiendo que la información está en formato CSV
        $data = explode(';', $info);
        $this->velocidad = $data[5];
        $this->camuflaje = $data[6];
        $this->radio = $data[7];
    }
}

// Subclase Cigarro que extiende de OVNI
class Cigarro extends OVNI {
    private $longitud;

    public function pintarHTML() {
        return "<p>Cigarro</p>";
    }

    public function cargarInfo($info) {
        // Suponiendo que la información está en formato CSV
        $data = explode(';', $info);
        $this->velocidad = $data[5];
        $this->camuflaje = $data[6];
        $this->longitud = $data[7];
    }
}

// Subclase LuzMisteriosa que extiende de OVNI
class LuzMisteriosa extends OVNI {
    private $duracion;

    public function pintarHTML() {
        return "<p>Luz Misteriosa</p>";
    }

    public function cargarInfo($info) {
        // Suponiendo que la información está en formato CSV
        $data = explode(';', $info);
        $this->velocidad = $data[5];
        $this->camuflaje = $data[6];
        $this->duracion = $data[7];
    }
}

// Definición de la clase Avistamiento
class Avistamiento {
    private $localizacion;
    private $fecha;
    private $hora;
    private $notas;
    private $objetoOVNI;

    public function __construct($localizacion, $fecha, $hora, $notas, OVNI $objetoOVNI) {
        $this->localizacion = $localizacion;
        $this->fecha = $fecha;
        $this->hora = $hora;
        $this->notas = $notas;
        $this->objetoOVNI = $objetoOVNI;
    }

    public function pintarHTML() {
        return "<p>Localización: $this->localizacion, Fecha: $this->fecha, Hora: $this->hora, Notas: $this->notas</p>" . $this->objetoOVNI->pintarHTML();
    }

    public function cargarInfo($info) {
        // Suponiendo que la información está en formato CSV
        $data = explode(';', $info);
        $this->localizacion = $data[0];
        $this->fecha = $data[1];
        $this->hora = $data[2];
        $this->notas = $data[3];

        // Determinar el tipo de OVNI y crear el objeto correspondiente
        switch ($data[4]) {
            case 'disco':
                $this->objetoOVNI = new DiscoVolador();
                break;
            case 'cigarro':
                $this->objetoOVNI = new Cigarro();
                break;
            default:
                $this->objetoOVNI = new LuzMisteriosa();
                break;
        }

        // Cargar información del OVNI
        $this->objetoOVNI->cargarInfo($info);
    }
}

// Función autoload para cargar las clases automáticamente
spl_autoload_register(function ($class_name) {
    include $class_name . '.php';
});

// Carga de avistamientos desde un archivo CSV
$avistamientos = [];
$file = fopen('avistamientos.csv', 'r');
while (($line = fgets($file)) !== false) {
    // Separar los datos del CSV
    $data = explode(';', $line);

    // Crear un objeto OVNI según el tipo
    switch ($data[4]) {
        case 'disco':
            $objetoOVNI = new DiscoVolador();
            break;
        case 'cigarro':
            $objetoOVNI = new Cigarro();
            break;
        default:
            $objetoOVNI = new LuzMisteriosa();
            break;
    }

    // Crear un objeto Avistamiento y cargar la información
    $avistamiento = new Avistamiento($data[0], $data[1], $data[2], $data[3], $objetoOVNI);
    $avistamiento->cargarInfo($line);
    $avistamientos[] = $avistamiento;
}
fclose($file);

// Mostrar listado de avistamientos
foreach ($avistamientos as $avistamiento) {
    echo $avistamiento->pintarHTML();
}