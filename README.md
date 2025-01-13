# Prueba técnica Matías Montoya para UTAL.

El proyecto se basa en una prueba de conocimientos intermedios/avanzados sobre el uso de las APIs e JSON Web Tokens (JWT),
implementada con PHP 8 y el framework Laravel 9.

## Requisitos.

Requisitos previos para que tu proyecto funcione correctamente:

- PHP 8.
- Composer.
- MySQL (No aplica), se utilizó MockAPI.
- Node.js y npm (No aplica).

### Pasos.

1. Clonar el repositorio indicado en el correo (git clone <repositorio>).
2. Acceder al directorio y ejecutar composer, instalar composer si no lo está en el equipo.
2.1. Abrir una terminar desde VS o cmd: ejecutar los comandos cd <carpeta del proyecto> y luego el comando composer install.
3. Generar una clave de aplicación unica, siempre y cuando lo solicite laravel, luego abrir terminal y ejecutar el siguiente
comando para utilizar la autenticación de JWT: php artisan key:generate.
4. Luego ejecutar el proyecto con la siguiente linea de código: php artisan serve o php artisan serve --host=<ip>
si desean acceder en más de un dispositivo al proyecto.
5. Al ejecurtarse, la terminar generará una URL. Al iniciar, se iniciará un "alert" con la URL de MockAPI en donde se encuentran las cuentas para iniciar sesión y realizar las pruebas.
6. Se usaron librerias y modificaciones complejas para ambientar la API a la estructura que se usa en Laravel.
