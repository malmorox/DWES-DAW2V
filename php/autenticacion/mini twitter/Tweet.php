<?php

    class Tweet {
        private $nombreUsuario;
        private $fotoPerfilUsuario;
        private $contenido;
        private $fechaHora;
    
        public function __construct($nombreUsuario, $fotoPerfilUsuario, $contenido, $fechaHora) {
            $this->nombreUsuario = $nombreUsuario;
            $this->fotoPerfilUsuario = $fotoPerfilUsuario;
            $this->contenido = $contenido;
            $this->fechaHora = date('Y-m-d H:i:s');
        }
    
        public function __toString() {
            return 
                '<div class="tweet">
                    <div class="col1">
                        <img src="' . $this->fotoPerfilUsuario . '" alt="Foto de perfil de @' . $this->nombreUsuario . '">
                    </div>
                    <div class="col2">
                        <span>' . $this->nombreUsuario . '</span>
                        <p>' . $this->contenido . '</p>
                        <span>' . $this->fechaHora . '</span>
                    </div>
                </div>';
        }
    }

?>