# Práctica: Herencia en PHP

## Objetivo

Implementar herencia en PHP creando una clase Admin que extiende de la clase Usuario.

## Herencia Aplicada

La clase `Admin` hereda de la clase `Usuario` usando la palabra clave `extends`.

```php
class Admin extends Usuario {
    public function getRol() {
        return "Administrador";
    }
}
```

Esto significa que Admin:
- Hereda todos los atributos de Usuario (nombre, correo)
- Hereda todos los métodos de Usuario (getNombre, getCorreo, setNombre, setCorreo)
- Agrega su propio método getRol()

## Diferencias entre Usuario y Admin

| Característica | Usuario | Admin |
|----------------|---------|-------|
| Tipo | Clase base | Clase derivada |
| Atributos | nombre, correo | Hereda: nombre, correo |
| Métodos propios | Constructor, getters, setters | getRol() |
| Puede usar | Sus propios métodos | Sus métodos + métodos de Usuario |

## Archivos

- `Usuario.php` - Clase base
- `Admin.php` - Clase que hereda de Usuario
- `index.php` - Prueba de herencia
- `README.md` - Este archivo

## Cómo ejecutar

Copia los archivos a `htdocs` (XAMPP).

## Ejemplo de uso

```php
$admin = new Admin("Maciel Gonzalez", "macielalain@gmail.com");

// Métodos heredados de Usuario
echo $admin->getNombre();  // Maciel Gonzalez
echo $admin->getCorreo();  // macielalain@gmail.com

// Método propio de Admin
echo $admin->getRol();     // Administrador
```
![Evidencia:](evidencia.jpg)

## Resultado esperado

Al ejecutar el código se muestra:
- Nombre del administrador
- Correo del administrador
- Rol: "Administrador"

Demostrando que Admin hereda correctamente de Usuario y agrega funcionalidad propia.