<?php
namespace Controllers;

use Models\ProductoModel;

class ProductoController
{
    private ProductoModel $productoModel;

    // Inicializa el modelo de productos
    public function __construct()
    {
        $this->productoModel = new ProductoModel();
    }

    // Verifica que el admin tenga sesión activa
    private function verificarSesion(): void
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if (!isset($_SESSION['admin'])) {
            header('Location: /TIENDA_MVC/login');
            exit;
        }
    }

    // Muestra todos los productos en el panel admin
    public function index(): void
    {
        $this->verificarSesion();
        $productos = $this->productoModel->obtenerTodos();
        require_once __DIR__ . '/../views/productos/index.php';
    }

    // Muestra el catálogo público con paginación de 4 en 4
    public function catalogo(): void
    {
        $porPagina = 4;
        $paginaActual = (int)($_GET['pagina'] ?? 1);
        if ($paginaActual < 1) { 
            $paginaActual = 1; 
        }

        $offset = ($paginaActual - 1) * $porPagina;
        $totalProductos = $this->productoModel->contarTotal();
        $productos = $this->productoModel->obtenerPorPagina($porPagina, $offset);
        $totalPaginas = (int)ceil($totalProductos / $porPagina);

        require_once __DIR__ . '/../views/public/catalogo.php'; 
    }

    // Muestra el formulario para registrar un nuevo producto
    public function create(): void
    {
        $this->verificarSesion();
        require_once __DIR__ . '/../views/productos/create.php';
    }

    // Valida y guarda un nuevo producto en la base de datos
    public function store(): void
    {
        $this->verificarSesion();

        // Validación del token CSRF
        $tokenFormulario = $_POST['csrf_token'] ?? '';
        $tokenSesion = $_SESSION['csrf_token'] ?? '';

        if ($tokenFormulario === '' || !hash_equals($tokenSesion, $tokenFormulario)) {
            $_SESSION['error'] = 'Error de seguridad: token CSRF inválido.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        // Recopila los datos del formulario
        $data = [
            'sku' => trim($_POST['sku'] ?? ''),
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio_compra' => trim($_POST['precio_compra'] ?? ''),
            'precio_venta' => trim($_POST['precio_venta'] ?? ''),
            'existencia' => trim($_POST['existencia'] ?? ''),
            'imagen' => $_FILES['imagen'] ?? null
        ];

        // Verifica que todos los campos estén llenos
        if (
            $data['sku'] === '' ||
            $data['nombre'] === '' ||
            $data['descripcion'] === '' ||
            $data['precio_compra'] === '' ||
            $data['precio_venta'] === '' ||
            $data['existencia'] === '' ||
            $data['imagen'] === null
        ) {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        // Verifica que los precios y existencia sean numéricos
        if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
            || !is_numeric($data['existencia'])) {
            $_SESSION['error'] = 'Precio de compra, precio de venta y existencia deben ser numéricos.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        $precioCompra = (float)$data['precio_compra'];
        $precioVenta = (float)$data['precio_venta'];
        $existencia = (int)$data['existencia'];

        // No se permiten valores negativos
        if ($precioCompra < 0 || $precioVenta < 0 || $existencia < 0) {
            $_SESSION['error'] = 'No se permiten valores negativos en precios.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        // El precio de venta no puede ser menor al de compra
        if ($precioVenta < $precioCompra) {
            $_SESSION['error'] = 'El precio de venta no puede ser menor que el precio de compra.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        // Verifica que el SKU no esté duplicado
        if ($this->productoModel->verificarSkuDuplicado($data['sku'])) {
            $_SESSION['error'] = 'El SKU ya se encuentra registrado.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        // Guarda la imagen en la carpeta img
        $nombreImagen = basename($data['imagen']['name']);
        $rutaDestino = __DIR__ . '/../views/img/' . $nombreImagen;

        if (move_uploaded_file($data['imagen']['tmp_name'], $rutaDestino)) {
            $data['imagen'] = $nombreImagen;
        } else {
            $_SESSION['error'] = 'Error al subir la imagen.';
            header('Location: /TIENDA_MVC/productos/create');
            exit;
        }

        //bitacora.log
        if ($this->productoModel->crear($data)) {
            $_SESSION['success'] = 'Producto registrado correctamente.';
            $this->registrarEnLog('Agregó el producto con SKU: ' . $data['sku']);
        } else {
            $_SESSION['error'] = 'No fue posible registrar el producto.';
        }

        header('Location: /TIENDA_MVC/productos');
        exit;
    }

    // Muestra el formulario para editar un producto existente
    public function edit(): void
    {
        $this->verificarSesion();

        $id = (int)($_GET['id'] ?? 0);
        $producto = $this->productoModel->obtenerPorId($id);

        if (!$producto) {
            $_SESSION['error'] = 'Producto no encontrado.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        require_once __DIR__ . '/../views/productos/edit.php';
    }

    // Valida y actualiza los datos de un producto (la imagen no se modifica)
    public function update(): void
    {
        $this->verificarSesion();

        $id = (int)($_POST['id'] ?? 0);

        // Validación del token CSRF
        $tokenFormulario = $_POST['csrf_token'] ?? '';
        $tokenSesion = $_SESSION['csrf_token'] ?? '';

        if ($tokenFormulario === '' || !hash_equals($tokenSesion, $tokenFormulario)) {
            $_SESSION['error'] = 'Error de seguridad: token CSRF inválido.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        $productoActual = $this->productoModel->obtenerPorId($id);
        if (!$productoActual) {
            $_SESSION['error'] = 'Producto no encontrado.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        if ($id <= 0) {
            $_SESSION['error'] = 'ID inválido.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        // Conserva la imagen actual sin modificarla
        $data = [
            'sku' => trim($_POST['sku'] ?? ''),
            'nombre' => trim($_POST['nombre'] ?? ''),
            'descripcion' => trim($_POST['descripcion'] ?? ''),
            'precio_compra' => trim($_POST['precio_compra'] ?? ''),
            'precio_venta' => trim($_POST['precio_venta'] ?? ''),
            'existencia' => trim($_POST['existencia'] ?? ''),
        ];

        if (
            $data['sku'] === '' ||
            $data['nombre'] === '' ||
            $data['descripcion'] === '' ||
            $data['precio_compra'] === '' ||
            $data['precio_venta'] === '' ||
            $data['existencia'] === ''
        ) {
            $_SESSION['error'] = 'Todos los campos son obligatorios.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        if (!is_numeric($data['precio_compra']) || !is_numeric($data['precio_venta'])
            || !is_numeric($data['existencia'])) {
            $_SESSION['error'] = 'Precio de compra, precio de venta y existencia deben ser numéricos.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        $precioCompra = (float)$data['precio_compra'];
        $precioVenta = (float)$data['precio_venta'];
        $existencia = (int)$data['existencia'];

        if ($precioCompra < 0 || $precioVenta < 0 || $existencia < 0) {
            $_SESSION['error'] = 'No se permiten valores negativos en precios o existencias.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        if ($precioVenta < $precioCompra) {
            $_SESSION['error'] = 'El precio de venta no puede ser menor que el precio de compra.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        // Verifica que el SKU no pertenezca a otro producto
        if ($this->productoModel->verificarSkuDuplicado($data['sku'], $id)) {
            $_SESSION['error'] = 'El SKU ya pertenece a otro producto.';
            header('Location: /TIENDA_MVC/productos/edit?id=' . $id);
            exit;
        }

        if ($this->productoModel->actualizar($id, $data)) {
            $_SESSION['success'] = 'Producto actualizado correctamente.';
            $this->registrarEnLog('Editó el producto con SKU: ' . $data['sku']);
        } else {
            $_SESSION['error'] = 'No fue posible actualizar el producto.';
        }

        header('Location: /TIENDA_MVC/productos');
        exit;
    }

    // Elimina un producto de la base de datos
    public function delete(): void
    {
        $this->verificarSesion();

        // Validación del token CSRF
        $tokenFormulario = $_POST['csrf_token'] ?? '';
        $tokenSesion = $_SESSION['csrf_token'] ?? '';

        if ($tokenFormulario === '' || !hash_equals($tokenSesion, $tokenFormulario)) {
            $_SESSION['error'] = 'Error de seguridad: token CSRF inválido.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        $id = (int)($_POST['id'] ?? 0);

        if ($id <= 0) {
            $_SESSION['error'] = 'ID inválido.';
            header('Location: /TIENDA_MVC/productos');
            exit;
        }

        $producto = $this->productoModel->obtenerPorId($id);
        if ($producto && !empty($producto['imagen']) && file_exists(__DIR__ . '/../views/img/' . $producto['imagen'])) {
            unlink(__DIR__ . '/../views/img/' . $producto['imagen']);
        }

        if ($this->productoModel->eliminar($id)) {
            $_SESSION['success'] = 'Producto eliminado correctamente.';
            $this->registrarEnLog('Eliminó el producto con ID: ' . $id);
        } else {
            $_SESSION['error'] = 'No fue posible eliminar el producto.';
        }

        header('Location: /TIENDA_MVC/productos');
        exit;
    }

    // Registra las acciones del admin en el archivo bitacora.log
    private function registrarEnLog(string $detalle): void
    {
        $usuario = $_SESSION['admin']['username'] ?? 'Desconocido';
        $fecha = date('d/m/Y H:i:s');
        $linea = "[$fecha] $detalle el usuario: $usuario" . PHP_EOL;
        file_put_contents(__DIR__ . '/../bitacora.log', $linea, FILE_APPEND);
    }

    // Endpoint API REST que devuelve todos los productos en formato JSON
    public function apiIndex(): void
    {
        if (ob_get_length()) {
            ob_clean();
        }

        header("Access-Control-Allow-Origin: *");
        header("Content-Type: application/json; charset=UTF-8");
        header("Access-Control-Allow-Methods: GET");

        try {
            $productos = $this->productoModel->obtenerTodos();

            if (!empty($productos)) {
                http_response_code(200);
                echo json_encode($productos, JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT);
            } else {
                http_response_code(404);
                echo json_encode(["message" => "No se encontraron productos registrados."], JSON_UNESCAPED_UNICODE);
            }
        } catch (\Exception $e) {
            http_response_code(500);
            echo json_encode([
                "error" => "Error interno en el servidor",
                "details" => $e->getMessage()
            ], JSON_UNESCAPED_UNICODE);
        }
        
        exit; 
    }
}
