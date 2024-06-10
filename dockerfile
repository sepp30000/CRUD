FROM php:apache
# Instala el módulo de PDO para realizar el CRUD con PDO
RUN apt-get update && apt-get install -y libpq-dev \
    && docker-php-ext-install pdo pdo_pgsql







