# Используем официальный образ PHP с установленным FPM
FROM php:8.2-fpm

# Устанавливаем необходимые зависимости
RUN apt-get update && apt-get install -y \
    libpq-dev \
    libzip-dev \
    unzip \
    curl \
    && docker-php-ext-install zip pdo pdo_pgsql opcache

# Устанавливаем Redis PHP-расширение
RUN pecl install redis && docker-php-ext-enable redis

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Создаем рабочую директорию
WORKDIR /var/www

# Копируем файлы проекта
COPY . .

# Устанавливаем зависимости проекта
RUN composer install --no-dev --optimize-autoloader

# Устанавливаем права доступа
RUN chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache

# Указываем команду запуска
CMD ["php-fpm"]

EXPOSE 9000
