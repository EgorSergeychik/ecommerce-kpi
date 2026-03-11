# Stage 1: Build dependencies
FROM composer:2.7 AS builder
WORKDIR /app
COPY . .
RUN composer install --no-dev --ignore-platform-reqs --optimize-autoloader

# Stage 2: Production image
FROM dunglas/frankenphp:php8.3-alpine
WORKDIR /var/www/html

RUN apk add --no-cache bash \
    && docker-php-ext-install pdo pdo_mysql pcntl

COPY --from=builder /app /var/www/html

RUN chmod +x /var/www/html/entrypoint.sh

EXPOSE 8000

ENTRYPOINT ["/var/www/html/entrypoint.sh"]
