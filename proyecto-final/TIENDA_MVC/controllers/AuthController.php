<?php namespace Controllers;

use Models\UsuarioModel;

class AuthController
{
    /**
     * Muestra la vista del formulario de inicio de sesión.
     */
    public function showLogin(): void
    {
        require_once __DIR__ . '/../views/auth/login.php';
    }

    /**
     * Procesa la autenticación del usuario, valida credenciales 
     * y crea la sesión del administrador.
     */
    public function login(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        $username = trim($_POST['username'] ?? '');
        $password = trim($_POST['password'] ?? '');

        if ($username === '' || $password === '') {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: /TIENDA_MVC/login');
            exit;
        }

        // Validación CSRF
        if (
            !isset($_POST['csrf_token']) ||
            !isset($_SESSION['csrf_token']) ||
            !hash_equals($_SESSION['csrf_token'], $_POST['csrf_token'])
        ) {
            $_SESSION['error'] = 'Token de seguridad inválido.';
            header('Location: /TIENDA_MVC/login');
            exit;
        }

        $usuarioModel = new UsuarioModel();
        $usuario = $usuarioModel->buscarPorUsername($username);

        if ($usuario && password_verify($password, $usuario['password'])) 
        {
            $_SESSION['admin'] = [
                'id' => $usuario['id'],
                'username' => $usuario['username'],
                'nombre_completo' => $usuario['nombre_completo']
            ];

            $fecha = date('d/m/Y H:i:s');
            $linea = "[$fecha] Sesión iniciada por el usuario: " . $usuario['username'] . PHP_EOL;
            file_put_contents(__DIR__ . '/../bitacora.log', $linea, FILE_APPEND);

            $_SESSION['success'] = 'Bienvenido, ' . $usuario['nombre_completo'] . '.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        $_SESSION['error'] = 'Credenciales incorrectas.';
        header('Location: /TIENDA_MVC/login');
        exit;
    }

    /**
     * Destruye la sesión activa del usuario y redirige al login.
     */
    public function logout(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['admin']['username'])) {
            $fecha = date('d/m/Y H:i:s');
            $linea = "[$fecha] Sesión cerrada por el usuario: " . $_SESSION['admin']['username'] . PHP_EOL;
            file_put_contents(__DIR__ . '/../bitacora.log', $linea, FILE_APPEND);
        }

        session_destroy();
        header('Location: /TIENDA_MVC/login');
        exit;
    }
}
