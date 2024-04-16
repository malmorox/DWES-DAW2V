<?php

include 'Alerta.php';

class AlertaError extends Alerta {
    public function mostrar() {
        echo "<h2 style='color: red; text-decoration: underline;'> {$this->titulo} </h2>";
        echo "<p> {$this->mensaje} </p>";
        echo "<div> <i class='fas fa-times-circle'> </i> </div>";
    }
}

?>