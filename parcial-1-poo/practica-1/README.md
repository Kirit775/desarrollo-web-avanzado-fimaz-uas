# Clase Usuario en PHP

Encapsulamiento con atributos privados, getters y setters.

## Archivos
- `Usuario.php` — la clase
- `index.php` — prueba
- `README.md` — este archivo

## Ejecutar
Copia los archivos a `htdocs` en XAMPP.

## Uso
```php
$usuario = new Usuario("Maciel Gonzalez", "macielalain@gmail.com");
echo $usuario->getNombre(); // Maciel Gonzalez
echo $usuario->getCorreo(); // macielalain@gmail.com
```
