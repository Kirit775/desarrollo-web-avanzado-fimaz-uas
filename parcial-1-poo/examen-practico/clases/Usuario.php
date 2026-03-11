<?php
class Usuario {
    private $nombre;
    private $correo;
    
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("El correo '$correo' no es valido");
        }
        
        $this->correo = $correo;
    }
    
    public function getNombre() {
        return $this->nombre;
    }
    
    public function getCorreo() {
        return $this->correo;
    }
}
?>
