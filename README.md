# Microservicio de Autenticación – Laravel 12 + Sanctum

Proyecto: PRY_AUTENTICACION_MICROSERVICIO

Base de datos: MySQL

Puerto por defecto: 8000

URL base: http://(ip-de-la-red):8000/api


**Integrantes del equipo:**

- Jonathan Hernández 
- Marco Chacón 
- Carlos Fernández 
- Sandy Mariño
- Sergio Condo 
- Carlos Cantuña 

## Descripción General

Este microservicio implementa un sistema de autenticación centralizada para un entorno distribuido.
Funciona mediante tokens personales (Laravel Sanctum), permitiendo que otros microservicios validen peticiones protegidas de forma segura.
Es el único servicio encargado de gestionar usuarios y tokens, por lo que actúa como “Punto Único de Autenticación” dentro del ecosistema.

## Objetivo del microservicio
Proveer autenticación segura basada en tokens (Sanctum) para todo el sistema distribuido.  
Es el único responsable de:
- Registro de usuarios (opcional)
- Login con generación de token personal
- Validación remota de tokens desde otros microservicios
- Devolver información del usuario autenticado (id, nombre, email, perfil)

## Características implementadas

| Funcionalidad                       | Endpoint                            | Método | Descripción |
|-------------------------------------|-------------------------------------|--------|-----------|
| Login                               | `/api/login`                        | POST   | Recibe email + password → devuelve token + datos del usuario |
| Validación de token (para otros servicios) | `/api/validate-token`     | GET    | Pro tegido con `auth:sanctum`. Usado por el microservicio de Posts |
| Información del usuario autenticado| `/api/user`                         | GET    | Devuelve datos completos del usuario |
| Cerrar sesión (revocar todos los tokens) | `/api/logout`                  | POST   | Elimina todos los tokens del usuario |
| Registro (opcional)                 | `/api/register`                     | POST   | Crea usuario con campos en español |

## Modelo User personalizado
- Campo `name` → renombrado a `nombre`
- Campo adicional: `perfil` (administrador | editor | usuario)
- Uso del trait `HasApiTokens` de Sanctum
- Password automáticamente hasheado

## Estructura clave
app/Models/User.php          ← campos en español + Sanctum
app/Http/Controllers/AuthController.php ← login y validateToken
app/Http/Controllers/Api/UserController.php ← register, logout, show
routes/api.php               ← rutas públicas y protegidas organizadas

## Requisitos del Sistema

PHP 8.2+

Composer

Laravel 12

MySQL

Extensión OpenSSL habilitada

Configuración de CORS para otros microservicios



## Ejemplo de respuesta exitosa (login)
```json
{
  "message": "Login exitoso",
  "token": "1|laravel_sanctum_abc123...",
  "user": {
    "id": 1,
    "nombre": "Administrador",
    "email": "admin@test.com",
    "perfil": "administrador"
  }
}



