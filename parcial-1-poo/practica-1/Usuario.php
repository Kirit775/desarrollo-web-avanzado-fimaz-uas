<?php
class Usuario {
    // Atributos privados
    private $nombre;
    private $correo;
    
    // Constructor
    public function __construct($nombre, $correo) {
        $this->nombre = $nombre;
        $this->correo = $correo;
    }
    
    // Getter para nombre
    public function getNombre() {
        return $this->nombre;
    }
    
    // Getter para correo
    public function getCorreo() {
        return $this->correo;
    }
    
    // Setter para nombre
    public function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    
    // Setter para correo
    public function setCorreo($correo) {
        $this->correo = $correo;
    }
}
?>