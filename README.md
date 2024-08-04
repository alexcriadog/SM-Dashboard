------------------------------------

IDEAS

- Hacer el switch de idiomas (Essencial)
- Claro / Oscuro (No essencial)
- Un chart dinamico (Essencial)
- Utilizar Vue.js con Tailwind para el Front (Essencial)

Funcionalidades:
- Switch entre idiomas.
- Usuarios.
- Esquema de base de datos (con modelos).
  - Datos de usuario.
  - Redes sociales que tiene.
  - Datos de cada red.
- Dos paginas, profile y insights.
- Pagina de insights. Queremos un tabs con las distintas redes sociales.
- Tabla dinamica (?).

Pasos a seguir:
- Instalar Vuejs y Tailwind. (1)
- Comentar todas las ideas que se han quedado en el tintero.
- Middleware (2)
    - Usuarios.
- Front (4)
    - Diseñar las vistas:
        - Vista de perfil.
        - Vista de Insights.
    - Maquetarlas (Responsive).
- Back (3)
    - Pensar estructura. ¿Entra algo de arquitectura hexagonal o DDD? (3.1)
    - Tests. (3.4)
    - BBDD (3.2)
        - Pensar estructura:
            - Users.
            - Metricas de distintas redes sociales.
            - 
        - Rellenar los datos con info de internet o por AI.
    - API (3.3)
        - Decidir que APIS consumimos.
    

ENDPOINT API MOCKY: https://run.mocky.io/v3/ab2f4b97-ea28-495b-b67a-36bc9805e153
EJEMPLOS DE LLAMADAS A NUESTRA API:
curl -X GET "https://your-app.herokuapp.com/api/followers/date-range?start_date=2024-07-01&end_date=2024-07-31"
curl -X GET "https://your-app.herokuapp.com/api/interactions/date-range?start_date=2024-07-01&end_date=2024-07-31"
curl -X GET "https://your-app.herokuapp.com/api/follower-stats/date-range?start_date=2024-07-01&end_date=2024-07-31"
