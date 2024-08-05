# Proyecto de Dashboard

Este proyecto es un dashboard para la visualización de datos de seguidores e interacciones en una plataforma social. Utiliza Laravel para el backend y Vue.js para el frontend. A continuación, se detalla la configuración, las funcionalidades implementadas, las ideas pendientes y cómo ejecutar el proyecto en local.

APP : **https://sm-dashboard-85573649b649.herokuapp.com/** 

## Funcionalidades Implementadas

1. **Endpoints de la API**:
   - `/followers/show/date-range`: Obtiene los seguidores en un rango de fechas.
   - `/followers/calculate/total-by-date-range`: Calcula el total de seguidores en un rango de fechas.
   - `/followers/calculate/count-by-group`: Calcula el número de seguidores por grupo.
   - `/interactions/show/date-range`: Obtiene las interacciones en un rango de fechas.
   - `/interactions/calculate/count`: Calcula el número de interacciones en un rango de fechas.
   - `/interactions/calculate/rate`: Obtiene la tasa de interacciones en un rango de fechas.
   - `/follower-stats/show/date-range`: Obtiene las estadísticas de seguidores en un rango de fechas.
   - `/combined-data`: Obtiene datos combinados de seguidores e interacciones.

2. **Configuración de Base de Datos**:
   - El proyecto utiliza una base de datos MySQL.
   - La configuración de la base de datos en Heroku con ClearDB se ha integrado para la producción.

3. **Deploy en Heroku**:
   - Este proyecto esta en la pagina de Heroku, tanto la aplicación como la BBDD.

4. **API**:
   - Hemos recreado una API en Mocky: https://run.mocky.io/v3/851e3cf0-0905-45b9-bf93-1fadf79ae06c
   - Mediante un comando he leido los datos y los he guardado en la BBDD. Utilizando Laravel Schedule.

4. **Front**:
   - He creado un Front-End responsive y con unos simples graficos.
   - He utilizado Tailwind.

## Ideas Pendientes

1. **Testing con PHPUnit**:
   - He comenzado con la implementación de los tests, pero debido a que no he tenido más tiempo, lo he tenido que dejar.

2. **Autenticación y Autorización**:
   - Implementar autenticación y autorización para proteger los endpoints de la API. He creado anteriormente tanto sistemas de protección con Tokens como sistemas de login (con SSO). Pero no he tenido tiempo de hacerlo.

3. **Traducciones**:
   - Me falta implementar un sistema de traducciones, en la empresa actual lo estoy implementando y se como se hace, pero no he podido realizarlo.

4. **Charts**:
   - Me hubiese gustado tener tiempo para implementar un grafico dinamico y algunos graficos más complejos. Pero el tiempo que he tenido ha sido muy limitado debido a mi trabajo actual.

## Ejecución en Local

### Requisitos

- **PHP** (versión 8.0 o superior)
- **Composer** (para la gestión de dependencias de PHP)
- **MySQL** (o compatible)
- **Node.js** (para la gestión de dependencias de frontend)
- **NPM/Yarn** (para la gestión de paquetes de frontend)

### Pasos para Ejecutar el Proyecto

1. **Clonar el Repositorio**
``` git clone https://github.com/alexcriadog/SM-Dashboard.git ``` 

2. **Dockers**
``` docker-compose up -d app ``` 

3. **NPM and COMPOSER install**
``` composer install ``` 
``` npm install ``` 

4. **NPM RUN**
``` npm run dev ``` 

4. **Abre la aplicacion**
La aplicacion estará en 'localhost:8080'