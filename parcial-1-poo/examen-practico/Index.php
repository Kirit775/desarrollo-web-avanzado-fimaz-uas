<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Sistema de Usuarios</title>
</head>
<body>
    <h2>Sistema de Usuarios - POO</h2>
    
    <?php
    require_once 'clases/Admin.php';
    require_once 'clases/Alumno.php';
    
    // Admin valido
    try {
        $admin = new Admin("Maciel Gonzalez", "macielalain@gmail.com");
    } catch (Exception $e) {
        echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    }
    
    // Alumno valido
    try {
        $alumno = new Alumno("Elena Ramirez", "elena.ramirez@universidad.mx", "141ABC");
    } catch (Exception $e) {
        echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    }
    
    // Alumno con correo invalido
    try {
        $error = new Alumno("Jose Martinez", "correo.invalido", "12asde");
    } catch (Exception $e) {
        echo "<p><strong>Error:</strong> " . $e->getMessage() . "</p>";
    }
    ?>
    
    <table border="1">
        <tr>
            <th>Nombre</th>
            <th>Correo</th>
            <th>Rol</th>
            <th>Matricula</th>
        </tr>
        <?php if (isset($admin)): ?>
        <tr>
            <td><?php echo $admin->getNombre(); ?></td>
            <td><?php echo $admin->getCorreo(); ?></td>
            <td><?php echo $admin->getRol(); ?></td>
            <td>-</td>
        </tr>
        <?php endif; ?>
        
        <?php if (isset($alumno)): ?>
        <tr>
            <td><?php echo $alumno->getNombre(); ?></td>
            <td><?php echo $alumno->getCorreo(); ?></td>
            <td><?php echo $alumno->getRol(); ?></td>
            <td><?php echo $alumno->getMatricula(); ?></td>
        </tr>
        <?php endif; ?>
    </table>
</body>
</html>