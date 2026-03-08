# Práctica 4 - Mini-Sistema POO en PHP

## Objetivo de la práctica

Construir un sistema POO en PHP que integra:
- Encapsulamiento
- Herencia
- Polimorfismo básico (método `getRol()` en clases hijas)
- Validación de datos
- Manejo de excepciones con try/catch
- Salida en tabla HTML

## Requisitos

- PHP 8.0 o superior
- XAMPP (Apache + PHP)
- Navegador web

## Estructura del proyecto

```
practica-4/
clases/
 Usuario.php   
 Admin.php     
 Alumno.php    
 Invitado.php  
├── index.php         
└── README.md         
```

## Ruta de ejecución en navegador

1. Copia la carpeta `practica-4` a `htdocs` de XAMPP
2. Inicia Apache desde el panel de control de XAMPP
3. Abre en tu navegador:
   ```
   http://localhost/
   ```

## Descripción de clases

### Usuario (clase base)
- Atributos: `nombre`, `correo`
- Valida que el correo tenga formato válido
- Lanza excepción si el correo es inválido

### Admin (hereda de Usuario)
- Método `getRol()` → "Administrador"

### Alumno (hereda de Usuario)
- Atributo adicional: `matricula`
- Método `getMatricula()`
- Método `getRol()` → "Alumno"

### Invitado (hereda de Usuario)
- Atributo adicional: `empresa`
- Método `getEmpresa()`
- Método `getRol()` → "Invitado"

## Evidencia esperada

### Tabla HTML con usuarios:

| Nombre | Correo | Rol | Matrícula | Empresa |
|--------|--------|-----|-----------|---------|
| Ana López | ana.lopez@admin.com | Administrador | — | — |
| Pedro García | pedro.garcia@estudiante.com | Alumno | A12345 | — |
| María Sánchez | maria.sanchez@empresa.com | Invitado | — | Universidad Autonoma de Sinaloa|

### Error controlado:
```
Error controlado: Correo inválido: 'correo-invalido' no tiene un formato válido
```

## Conceptos POO aplicados

✓ **Encapsulamiento:** Atributos privados/protected con getters  
✓ **Herencia:** Clases Admin, Alumno e Invitado extienden Usuario  
✓ **Polimorfismo:** Método `getRol()` en todas las clases hijas  
✓ **Validación:** Formato de correo con `filter_var()`  
✓ **Excepciones:** Uso de `throw`, `try` y `catch`

## Evidencia mínima cumplida

Código corre sin errores fatales  
Tabla HTML se muestra correctamente  

Excepción se captura y se muestra mensaje controlado
![evidencia4](https://github.com/user-attachments/assets/bf12199c-390f-4433-82d0-49135f0dbac7)
