# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar herramientas necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    curl \
    libzip-dev \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    nodejs \
    npm \
    && rm -rf /var/lib/apt/lists/*

# Instalar extensiones de PHP necesarias para Laravel
RUN docker-php-ext-install pdo pdo_mysql
RUN docker-php-ext-configure gd --with-freetype --with-jpeg
RUN docker-php-ext-install gd

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Deshabilitar módulos MPM predeterminados y habilitar solo mpm_prefork
RUN a2dismod mpm_event && a2enmod mpm_prefork

# Copiar el archivo de configuración de Apache
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido de la aplicación al contenedor
COPY . .

# Instalar Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer

# Instalar dependencias de Laravel
RUN composer install --no-dev --optimize-autoloader

# Limpiar caché de Composer para reducir tamaño de la imagen
RUN composer clear-cache

# Instalar dependencias de Node.js
RUN npm install

# Construir activos de frontend
RUN npm run build

# Cambiar permisos de almacenamiento y caché para Laravel
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Copiar y configurar el script de inicio
COPY heroku-docker-start.sh /usr/local/bin/heroku-docker-start.sh
RUN chmod +x /usr/local/bin/heroku-docker-start.sh

# Exponer el puerto que será utilizado por Heroku
EXPOSE 80

# Comando por defecto para iniciar Apache en primer plano
CMD ["heroku-docker-start.sh"]
