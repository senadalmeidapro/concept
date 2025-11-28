FROM php:8.2-fpm

# Dépendances système + extensions PHP requises pour Laravel
RUN apt-get update && apt-get install -y \
    git unzip curl libzip-dev libpng-dev libonig-dev libxml2-dev zip default-mysql-client && \
    docker-php-ext-install pdo_mysql mbstring zip bcmath && \
    apt-get clean && rm -rf /var/lib/apt/lists/*

# Installer Composer
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

# Répertoire de travail
WORKDIR /app
