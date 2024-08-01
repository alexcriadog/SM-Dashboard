# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar dependencias del sistema
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    zip \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libonig-dev \
    libxml2-dev \
    libzip-dev \
    curl \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd pdo pdo_mysql mbstring zip exif pcntl

# Instalar Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar los archivos del proyecto
COPY . .

# Copiar archivo de configuración de Apache
COPY 000-default.conf /etc/apache2/sites-available/000-default.conf

# Instalar las dependencias de PHP
RUN composer install --no-dev --optimize-autoloader

# Configurar permisos adecuados
RUN chown -R www-data:www-data /var/www/html/storage /var/www/html/bootstrap/cache

# Configurar Apache
RUN a2enmod rewrite mpm_prefork && a2dismod mpm_worker mpm_event

# Exponer el puerto
EXPOSE 80

# Comando de inicio
CMD ["apache2-foreground"]
