FROM ubuntu:latest
LABEL authors="okmay"

# Используем официальный PHP образ
FROM php:8.1-fpm

# Устанавливаем необходимые зависимости
RUN apt-get update && apt-get install -y \
    libicu-dev \
    libpq-dev \
    zip \
    unzip \
    git \
    curl \
    && docker-php-ext-install intl pdo pdo_mysql

# Устанавливаем Composer
COPY --from=composer:latest /usr/bin/composer /usr/bin/composer

# Устанавливаем зависимости Symfony
WORKDIR /var/www/html
COPY composer.json composer.lock ./
RUN composer install --no-scripts --no-autoloader

# Копируем исходный код
COPY . .

# Сборка автозагрузчика Composer
RUN composer dump-autoload --optimize

# Настройка прав доступа
RUN chown -R www-data:www-data /var/www/html/var

# Открываем порт для PHP-FPM
EXPOSE 9000

CMD ["php-fpm"]
