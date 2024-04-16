<?php

include 'Alerta.php';

class AlertaWarning extends Alerta {
    public function mostrar() {
        echo "<h2 style='color: yellow; text-decoration: underline;'>{$this->titulo} </h2>";
        echo "<p> {$this->mensaje} </p>";
        echo "<div> <i class='fas fa-exclamation-triangle'> </i> </div>";
    }
}

?>