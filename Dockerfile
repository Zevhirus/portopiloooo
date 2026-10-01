# syntax=docker/dockerfile:1

# ---------- 1) Dependensi PHP ----------
# Harus duluan: resources/js/app.js meng-import vendor/tightenco/ziggy,
# jadi build Vite butuh folder vendor.
FROM composer:2 AS vendor
WORKDIR /app
COPY composer.json composer.lock ./
RUN composer install --no-dev --no-interaction --prefer-dist \
    --no-scripts --no-autoloader --ignore-platform-reqs
COPY . .
RUN composer dump-autoload --no-dev --optimize --no-scripts --ignore-platform-reqs

# ---------- 2) Build frontend (Vue + Vite) ----------
FROM node:22-alpine AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci --ignore-scripts
COPY . .
COPY --from=vendor /app/vendor ./vendor
RUN npm run build

# ---------- 3) Image final ----------
FROM php:8.4-apache

RUN apt-get update \
 && apt-get install -y --no-install-recommends libpq-dev libzip-dev \
 && docker-php-ext-install pdo_pgsql zip opcache \
 && a2enmod rewrite headers \
 && rm -rf /var/lib/apt/lists/*

# Pastikan HANYA satu MPM aktif (prefork, wajib untuk mod_php)
RUN rm -f /etc/apache2/mods-enabled/mpm_event.* /etc/apache2/mods-enabled/mpm_worker.* \
 && a2enmod mpm_prefork

# Apache melayani folder /public, dan .htaccess Laravel diizinkan
ENV APACHE_DOCUMENT_ROOT=/var/www/html/public
RUN sed -ri -e 's!/var/www/html!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/sites-available/*.conf \
 && sed -ri -e 's!/var/www/!${APACHE_DOCUMENT_ROOT}!g' /etc/apache2/apache2.conf /etc/apache2/conf-available/*.conf \
 && printf '<Directory /var/www/html/public>\n    AllowOverride All\n    Require all granted\n</Directory>\n' \
    > /etc/apache2/conf-available/laravel.conf \
 && a2enconf laravel

WORKDIR /var/www/html
COPY --from=vendor /app /var/www/html
COPY --from=assets /app/public/build /var/www/html/public/build

RUN mkdir -p storage/framework/cache/data storage/framework/sessions storage/framework/views \
             storage/logs storage/app/public bootstrap/cache database \
 && php artisan package:discover --ansi \
 && chown -R www-data:www-data storage bootstrap/cache database \
 && chmod -R ug+rwX storage bootstrap/cache database

COPY docker/entrypoint.sh /usr/local/bin/entrypoint.sh
COPY docker/create-admin.php /usr/local/bin/create-admin.php
RUN sed -i 's/\r$//' /usr/local/bin/entrypoint.sh && chmod +x /usr/local/bin/entrypoint.sh

ENV APP_ENV=production APP_DEBUG=false LOG_CHANNEL=stderr
EXPOSE 80
CMD ["/usr/local/bin/entrypoint.sh"]
