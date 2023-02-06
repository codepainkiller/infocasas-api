

# Infocasas Challenge

## Requisitos de sistema
- Tener MySQL instalado
- Tener instalado PHP, composer y las [extensiones](https://laravel.com/docs/7.x#server-requirements) que requiere Laravel
- Servidor web Apache2 o Nginx

## Pasos para levantae el API REST
1. Crear una base de datos con el nombre `infocasas`
2. Clonar repositorio
3. Ejecutar los siguientes comandos dentro del directorio del proyecto
 ```sh 
   cp .env.example .env
   composer install
   php artisan migrate --seed
   ```

4. Crear un virtual host para el `api` con el nombre `http://infocasas.test`

