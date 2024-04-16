<?php

require_once 'Alerta.php';

class AlertaError extends Alerta {
    public function mostrar() {
        echo "<h1 style='color: red; text-decoration: underline;'> {$this->titulo} </h1>";
        echo "<p> {$this->mensaje} <i class='fas fa-circle-xmark'> </i> </p>";
    }
}

?>