FROM php:8.3-fpm
RUN docker-php-ext-install pdo_mysql
RUN pecl install redis \ && docker-php-ext-enable redis
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

COPY . .
RUN composer install --no-dev --optimize-autoloader
RUN chown -R www-data:www-data storage bootstrap/cache
RUN chmod -R 775 storage bootstrap/cache
