# Práctica: Herencia y Excepciones en PHP

## Objetivo

Implementar herencia y manejo de excepciones validando el formato de correo electrónico.

## Clases

**Usuario (clase base)**
- Atributos: nombre, correo
- Valida que el correo sea válido
- Lanza excepción si el correo es incorrecto

**Admin (hereda de Usuario)**
- Método getRol() → "Administrador"

**Alumno (hereda de Usuario)**
- Atributo adicional: matricula
- Método getRol() → "Alumno"

## Archivos

- `Usuario.php` - Clase base con validación
- `Admin.php` - Clase Admin
- `Alumno.php` - Clase Alumno
- `index.php` - Pruebas con try/catch


## Ejecutar

Copia los archivos a `htdocs` (XAMPP).

## Ejemplo

```php
try {
    $admin = new Admin("Ana", "ana@admin.com");
    echo $admin->getRol(); // Administrador
} catch (Exception $e) {
    echo $e->getMessage();
}
```