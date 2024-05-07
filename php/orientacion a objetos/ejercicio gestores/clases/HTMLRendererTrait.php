<?php

    trait HTMLRenderer {
        public function renderHTML() {
            $html = "<h2>{$this->nombre}</h2>";
            $html .= "<p>{$this->descripcion}</p>";
            $html .= "<p>{$this->obtenerDetalle()}</p>";
            return $html;
        }
    }

?>    