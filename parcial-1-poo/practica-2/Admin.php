<?php
// Incluir la clase padre
require_once 'Usuario.php';

class Admin extends Usuario {
    
    // Método que retorna el rol
    public function getRol() {
        return "Administrador";
    }
}
?>