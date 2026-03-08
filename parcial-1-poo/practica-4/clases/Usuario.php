<?php
class Usuario {
    protected $nombre;
    protected $correo;
    
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        
        // Validar formato de correo
        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Correo inválido: '$correo' no tiene un formato válido");
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
