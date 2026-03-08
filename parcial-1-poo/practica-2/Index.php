<?php
        // Incluir la clase Admin (que a su vez incluye Usuario)
        require_once 'Admin.php';
        
        // Crear un objeto Admin
        $admin = new Admin("Maciel Gonzalezz", "macielalain@gmail.com");
        
        // Mostrar los datos usando métodos heredados y propios
        echo "<div class='info'>";
        echo "<p><span class='label'>Nombre:</span> " . $admin->getNombre() . "</p>";
        echo "<p><span class='label'>Correo:</span> " . $admin->getCorreo() . "</p>";
        echo "<p><span class='label'>Rol:</span> " . $admin->getRol() . "</p>";
        echo "</div>";
?>