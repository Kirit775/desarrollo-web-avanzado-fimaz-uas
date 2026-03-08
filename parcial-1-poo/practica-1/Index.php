<?php
        // Incluir el archivo de la clase Usuario
        require_once 'Usuario.php';
        
        // Crear una instancia de Usuario
        $usuario = new Usuario("Maciel Gonzalez", "macielalain@gmail.com");
        

        echo "<h1>Informacion del usuario</h1>";
        // Mostrar los valores usando los getters
       
        echo "<strong>Nombre:</strong> " . $usuario->getNombre() . "<br>";
        echo "<strong>Correo:</strong> " . $usuario->getCorreo();
       
        

?>
