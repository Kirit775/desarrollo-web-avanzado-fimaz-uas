<?php
require_once 'clases/Admin.php';
require_once 'clases/Alumno.php';

echo "Prueba de Herencia y Excepciones \n\n";

// Caso válido - Admin
echo "1. Creando Admin con correo válido:\n";
try {
    $admin = new Admin("Ana López", "ana@admin.com");
    echo " Aceptado:  " . $admin->getNombre() . " - " . $admin->getRol() . "\n\n";
} catch (Exception $e) {
    echo "    Error: " . $e->getMessage() . "\n\n";
}

// Caso válido - Alumno
echo "2. Creando Alumno con correo válido:\n";
try {
    $alumno = new Alumno("Pedro García", "pedro@gmail.com", "A12345");
    echo "  Aceptado " . $alumno->getNombre() . " - " . $alumno->getRol() . " - Matrícula: " . $alumno->getMatricula() . "\n\n";
} catch (Exception $e) {
    echo "    Error: " . $e->getMessage() . "\n\n";
}

// Caso inválido - Correo mal formado
echo "3. Intentando crear Admin con correo inválido:\n";
try {
    $error = new Admin("Carlos", "carlos123.com");
    echo "   Usuario creado\n\n";
} catch (Exception $e) {
    echo "   Error:" . $e->getMessage() . "\n\n";
}
?>