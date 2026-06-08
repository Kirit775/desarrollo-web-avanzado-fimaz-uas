# Catalogo y Gestor de Inventario - Arquitectura MVC PHP

Este proyecto es una aplicación web para la administración y visualización de productos. Está organizado bajo el patrón de diseño Modelo-Vista-Controlador (MVC), lo que significa que el código de las interfaces de usuario, la base de datos y la lógica de negocio se encuentran separados y ordenados.

---

## Tecnologías Utilizadas

* **PHP:** El lenguaje de programación principal del sistema.
* **MySQL y PDO:** Utilizados para la persistencia de datos de forma segura.
* **Bootstrap 5:** Framework para el diseño visual responsivo que se adapta a dispositivos móviles.
* **Apache (.htaccess):** Configuración para el manejo de rutas amigables y enmascaramiento de URLs.

---

## Funcionalidades Principales

* **Punto de Entrada Único:** Todas las peticiones del sistema pasan inicialmente por el archivo index.php, el cual se encarga de redirigir el flujo al controlador correspondiente.
* **Módulo API REST:** Permite exportar el catálogo completo de productos en formato JSON para que los datos puedan ser consumidos por otras aplicaciones, como una app móvil.
* **Seguridad Integrada:**
  * Control de acceso obligatorio mediante sesiones para resguardar las rutas administrativas.
  * Protección contra vulnerabilidades CSRF a través de la validación de tokens ocultos en los formularios.
  * Validaciones estrictas de datos que impiden el registro de valores vacíos, precios negativos o claves SKU duplicadas.
* **Paginación en el Servidor:** En la vista pública de la tienda, los productos se muestran en bloques de 4 en 4 para optimizar la velocidad de carga.
* **Registro de Eventos (Bitácora):** Cada acción crítica realizada por el administrador (crear, editar o eliminar productos) queda grabada con su fecha y hora exacta en el archivo local bitacora.log.

---

## Estructura de Directorios

```text
TIENDA_MVC/
 ┣ config          # Configuración de la base de datos y cargador automático de clases
 ┣ Controllers     # Cerebros del sistema: manejan el login, catálogo y productos
 ┣ Models          # Gestión de consultas y persistencia de datos con la base de datos
 ┣ views           # Archivos de presentación (HTML y CSS)
 ┃ ┣ layouts       # Componentes repetitivos como la cabecera y el pie de página
 ┃ ┣ productos     # Vistas del panel de administración (crear, editar, listar)
 ┃ ┗ public        # Vista del catálogo público para los clientes
 ┣ .htaccess       # Reglas de redirección para limpiar las URLs de la aplicación
 ┣ bitacora.log    # Historial de operaciones de escritura en el sistema
 ┗ index.php       # Archivo de inicio global del proyecto