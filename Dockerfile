# Usa una imagen oficial de PHP con Apache compatible con PHP 8.3
FROM php:8.3-apache

# Instalar dependencias necesarias del sistema (incluido Node.js para Vite)
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    zip \
    unzip \
    git \
    curl \
    && curl -fsSL https://deb.nodesource.com/setup_20.x | bash - \
    && apt-get install -y nodejs \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Habilitar mod_rewrite para Laravel en Apache
RUN a2enmod rewrite

# Apuntar el DocumentRoot de Apache a la carpeta /public de Laravel (Seguridad y Rutas)
RUN sed -ri -e 's!/var/www/html!/var/www/html/public!g' /etc/apache2/sites-available/*.conf
RUN sed -ri -e 's!/var/www/!/var/www/html/public!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf

# Instalar Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Copiar el código del proyecto al contenedor
WORKDIR /var/www/html
COPY . .

# Copiar archivo .env.example como .env si no existe
RUN cp .env.example .env

# Instalar dependencias de Composer sin dependencias de desarrollo y optimizando el cargador
RUN composer install --no-dev --optimize-autoloader

# Instalar dependencias de NPM y compilar assets de producción (Vite)
RUN npm install && npm run build

# Crear archivo de base de datos SQLite vacío
RUN mkdir -p database && touch database/database.sqlite

# Establecer permisos correctos para Apache (www-data)
RUN chown -R www-data:www-data /var/www/html \
    && chmod -R 775 /var/www/html/storage \
    && chmod -R 775 /var/www/html/bootstrap/cache

# Exponer el puerto estándar que Render mapea automáticamente
EXPOSE 80

# Comando de inicio: correr migraciones con seeders y arrancar Apache
CMD php artisan migrate --force --seed && apache2-foreground
