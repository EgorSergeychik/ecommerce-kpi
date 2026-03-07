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

echo "{\"timestamp\":\"$(date -u +"%Y-%m-%dT%H:%M:%SZ")\",\"level\":\"INFO\",\"message\":\"Running database migrations...\"}"
php artisan migrate --force --step

php artisan octane:start --server=frankenphp --host=0.0.0.0 --port=8000 &
APP_PID=$!

wait $APP_PID
