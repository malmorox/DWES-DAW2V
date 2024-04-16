<?php

require_once 'Alerta.php';

class AlertaAlarma extends Alerta {
    public function mostrar() {
        echo "<script> alert('{$this->titulo}: {$this->mensaje}'); </script>";
    }
}

?>