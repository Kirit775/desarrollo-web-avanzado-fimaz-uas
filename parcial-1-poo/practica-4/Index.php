<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Práctica 4 - POO en PHP</title>
</head>
<body>
    <h1>Práctica 4 - Sistema de Usuarios POO</h1>
    
    <?php
    require_once 'clases/Admin.php';
    require_once 'clases/Alumno.php';
    require_once 'clases/Invitado.php';
    
    $usuarios = [];
    
    try {
        // Crear usuarios válidos
        $usuarios[] = new Admin("Ana López", "ana.lopez@admin.com");
        $usuarios[] = new Alumno("Pedro García", "pedro.garcia@estudiante.com", "A12345");
        $usuarios[] = new Invitado("María Sánchez", "maria.sanchez@empresa.com", "Universidad Autonoma de Sinaloa");
        
        // Intentar crear usuario con correo inválido (disparará excepción)
        $usuarios[] = new Admin("Carlos Ruiz", "correo-invalido");
        
    } catch (Exception $e) {
        echo "<p><strong>Error controlado:</strong> " . $e->getMessage() . "</p>";
    }
    ?>
    
    <table>
        <thead>
            <tr>
                <th>Nombre</th>
                <th>Correo</th>
                <th>Rol</th>
                <th>Matrícula</th>
                <th>Empresa</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($usuarios as $usuario): ?>
            <tr>
                <td><?php echo $usuario->getNombre(); ?></td>
                <td><?php echo $usuario->getCorreo(); ?></td>
                <td><?php echo $usuario->getRol(); ?></td>
                <td>
                    <?php 
                    echo ($usuario instanceof Alumno) ? $usuario->getMatricula() : "—";
                    ?>
                </td>
                <td>
                    <?php 
                    echo ($usuario instanceof Invitado) ? $usuario->getEmpresa() : "—";
                    ?>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</body>
</html>