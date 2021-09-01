FROM killtw/php:7.4.15-caddy

COPY . .

RUN composer install --prefer-dist --no-ansi --no-interaction --no-progress --no-scripts --no-dev && \
    composer dump-autoload --optimize --no-dev --classmap-authoritative && \
    chown -R www-data:www-data /app && \
    chmod -R ug+rwx /app/storage /app/bootstrap/cache && \
    php artisan route:cache && \
    php artisan view:cache

CMD ["/usr/bin/caddy", "--conf", "/app/Caddyfile"]
