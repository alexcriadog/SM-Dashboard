# Usa una imagen base de PHP con Apache
FROM php:8.1-apache

# Instalar herramientas necesarias
RUN apt-get update && apt-get install -y \
    git \
    unzip \
    && rm -rf /var/lib/apt/lists/*
    
# Instalar extensiones de PHP necesarias
RUN docker-php-ext-install pdo pdo_mysql

# Habilitar mod_rewrite de Apache
RUN a2enmod rewrite

# Copiar el archivo de configuración de Apache
COPY ./000-default.conf /etc/apache2/sites-available/000-default.conf

# Establecer el directorio de trabajo
WORKDIR /var/www/html

# Copiar el contenido de la aplicación al contenedor
COPY . .

# Instalar dependencias de Composer
RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN composer install

# Exponer el puerto 80 para Apache
EXPOSE 80

# Comando por defecto para iniciar Apache en primer plano
CMD ["apache2-foreground"]
