<?php

require_once 'Alerta.php';

class AlertaWarning extends Alerta {
    public function mostrar() {
        echo "<h1 style='color: yellow; text-decoration: underline;'>{$this->titulo} </h1>";
        echo "<p> {$this->mensaje} <i class='fas fa-exclamation-triangle'> </i> </p>";
    }
}

?>