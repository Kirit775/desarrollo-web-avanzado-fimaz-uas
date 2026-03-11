# Examen Práctico - POO en PHP

## Objetivo

Crear un sistema de usuarios usando Programacion Orientada a Objetos con herencia, validacion de datos y manejo de excepciones.

## Estructura

```
 clases/
  Usuario.php  
  Admin.php    
  Alumno.php   
└── index.php        
```

## Clases

**Usuario**
- Atributos: nombre, correo
- Valida formato de correo
- Lanza excepcion si el correo es invalido

**Admin**
- Hereda de Usuario
- Metodo getRol() retorna "Administrador"

**Alumno**
- Hereda de Usuario
- Atributo adicional: matricula
- Metodo getRol() retorna "Alumno"

## Como ejecutar

- Copia la carpeta a htdocs


## Resultado

Se muestra una tabla con:
- Usuarios creados 
- Mensaje de error si el correo es invalido

