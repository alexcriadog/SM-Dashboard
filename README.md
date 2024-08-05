# Proyecto de Dashboard

Este proyecto es un dashboard para la visualización de datos de seguidores e interacciones en una plataforma social. Utiliza Laravel para el backend y Vue.js para el frontend. A continuación, se detalla la configuración, las funcionalidades implementadas, las ideas pendientes y cómo ejecutar el proyecto en local.

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

2. **Testing con PHPUnit**:
   - Se han configurado pruebas unitarias para los endpoints de la API utilizando PHPUnit.
   - Las pruebas se ejecutan localmente para verificar el correcto funcionamiento de los endpoints.

3. **Middleware**:
   - Se ha implementado middleware para filtrar solicitudes y aplicar lógica adicional en el procesamiento de las mismas.

4. **Configuración de Base de Datos**:
   - El proyecto utiliza una base de datos MySQL.
   - La configuración de la base de datos en Heroku con ClearDB se ha integrado para la producción.

## Ideas Pendientes

1. **Optimización de Consultas**:
   - Revisar y optimizar las consultas a la base de datos para mejorar el rendimiento.

2. **Autenticación y Autorización**:
   - Implementar autenticación y autorización para proteger los endpoints de la API.

3. **Mejora del Frontend**:
   - Mejorar la interfaz de usuario en el frontend para una experiencia de usuario más intuitiva.

4. **Documentación Adicional**:
   - Completar la documentación del proyecto, incluyendo instrucciones detalladas para la configuración del entorno de desarrollo y despliegue.

## Ejecución en Local

### Requisitos

- **PHP** (versión 8.0 o superior)
- **Composer** (para la gestión de dependencias de PHP)
- **MySQL** (o compatible)
- **Node.js** (para la gestión de dependencias de frontend)
- **NPM/Yarn** (para la gestión de paquetes de frontend)

### Pasos para Ejecutar el Proyecto

1. **Clonar el Repositorio**:

   ```bash
   git clone <URL_DEL_REPOSITORIO>
   cd <NOMBRE_DEL_PROYECTO>
