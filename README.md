# Dashboard Project

This project is a dashboard for visualizing followers and interaction data on a social platform. It uses Laravel for the backend and Vue.js for the frontend. Below are details on the setup, implemented features, pending ideas, and how to run the project locally.

APP: **https://sm-dashboard-85573649b649.herokuapp.com/**

## Implemented Features

1. **API Endpoints**:
   - `/followers/show/date-range`: Retrieves followers within a date range.
   - `/followers/calculate/total-by-date-range`: Calculates the total number of followers within a date range.
   - `/followers/calculate/count-by-group`: Calculates the number of followers by group.
   - `/interactions/show/date-range`: Retrieves interactions within a date range.
   - `/interactions/calculate/count`: Calculates the number of interactions within a date range.
   - `/interactions/calculate/rate`: Retrieves the interaction rate within a date range.
   - `/follower-stats/show/date-range`: Retrieves follower statistics within a date range.
   - `/combined-data`: Retrieves combined data for followers and interactions.

2. **Database Configuration**:
   - The project uses a MySQL database.
   - The database configuration on Heroku with ClearDB has been integrated for production.

3. **Deploy on Heroku**:
   - This project is deployed on Heroku, including both the application and the database.

4. **API**:
   - We have recreated an API on Mocky: [Mocky API](https://run.mocky.io/v3/851e3cf0-0905-45b9-bf93-1fadf79ae06c)
   - Using a command, I have read the data and saved it in the database, utilizing Laravel Schedule.

5. **Front**:
   - I have created a responsive frontend with simple charts.
   - Tailwind was used for styling.

## Pending Ideas

1. **Testing with PHPUnit**:
   - I started implementing tests, but due to time constraints, I had to leave it incomplete.

2. **Authentication and Authorization**:
   - Implement authentication and authorization to protect the API endpoints. I have previously created token-based protection systems and login systems (with SSO) but did not have time to implement this.

3. **Translations**:
   - A translation system is missing. I am implementing it in my current job and know how to do it, but I was unable to complete it.

4. **Charts**:
   - I would have liked to have time to implement dynamic charts and some more complex charts, but my time was very limited due to my current work.

## Running Locally

### Requirements

- **PHP** (version 8.0 or higher)
- **Composer** (for managing PHP dependencies)
- **MySQL** (or compatible)
- **Node.js** (for managing frontend dependencies)
- **NPM/Yarn** (for managing frontend packages)

### Steps to Run the Project

1. **Clone the Repository**
   ```bash
   git clone https://github.com/alexcriadog/SM-Dashboard.
   ```

2. **Dockers**
   ```bash  
   docker-compose up -d app 
   ``` 

3. **NPM and COMPOSER install**
   ```bash  
   composer install 
   npm install 
   ``` 

4. **NPM RUN**
   ```bash
   npm run dev 
   ``` 

5. **The application will be available at localhost:8080**

