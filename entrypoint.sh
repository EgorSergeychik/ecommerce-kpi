#!/bin/bash

graceful_shutdown() {
    TIMESTAMP=$(date -u +"%Y-%m-%dT%H:%M:%SZ")

    echo "{\"timestamp\":\"$TIMESTAMP\",\"level\":\"INFO\",\"message\":\"SIGTERM received. Starting graceful shutdown...\"}"

    if [ ! -z "$APP_PID" ]; then
        kill -15 $APP_PID
        wait $APP_PID
    fi
    exit 0
}

trap graceful_shutdown SIGTERM

until php -r "try { new PDO('mysql:host=' . getenv('DB_HOST') . ';port=' . getenv('DB_PORT') . ';dbname=' . getenv('DB_DATABASE'), getenv('DB_USERNAME'), getenv('DB_PASSWORD')); exit(0); } catch (Exception \$e) { exit(1); }" > /dev/null 2>&1; do
    sleep 1
done

echo "{\"timestamp\":\"$(date -u +"%Y-%m-%dT%H:%M:%SZ")\",\"level\":\"INFO\",\"message\":\"Running database migrations...\"}"
php artisan migrate --force --step --quiet

echo "{\"timestamp\":\"$(date -u +"%Y-%m-%dT%H:%M:%SZ")\",\"level\":\"INFO\",\"message\":\"Starting FrankenPHP server...\"}"
php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000 --no-ansi --quiet > /dev/null 2>&1 &
APP_PID=$!

wait $APP_PID
