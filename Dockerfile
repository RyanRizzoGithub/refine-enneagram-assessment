# ============================================================
# theREFINEnetwork Enneagram assessment — Railway deploy image
# Laravel 6 / PHP 7.4 + Postgres (Supabase), nginx + php-fpm.
# Multi-stage: build Vue/Sass assets, then assemble PHP runtime.
# ============================================================

# ---------- stage 1: build front-end assets ----------
FROM node:16-bullseye AS assets
WORKDIR /app
COPY package.json package-lock.json ./
RUN npm ci
COPY . .
RUN npm run prod

# ---------- stage 2: PHP runtime ----------
FROM php:7.4-fpm-bullseye AS app

# System libs + the PHP extensions Laravel 6 + Postgres need.
RUN apt-get update && apt-get install -y --no-install-recommends \
        nginx \
        libpq-dev \
        libonig-dev \
        libzip-dev \
        unzip \
        git \
    && docker-php-ext-install pdo pdo_pgsql pgsql mbstring bcmath zip \
    && apt-get clean && rm -rf /var/lib/apt/lists/*

# Composer (copied from the official image).
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# App source, then overlay the compiled assets from stage 1.
COPY . .
COPY --from=assets /app/public/ ./public/

# PHP dependencies (no dev, optimized; skip scripts so no env is needed at build).
RUN composer install --no-dev --optimize-autoloader --no-interaction --no-scripts

# Writable dirs for Laravel.
RUN chown -R www-data:www-data storage bootstrap/cache \
    && chmod -R 775 storage bootstrap/cache

# nginx + startup.
COPY docker/nginx.conf /etc/nginx/conf.d/default.conf
RUN rm -f /etc/nginx/sites-enabled/default
COPY docker/start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Railway provides $PORT at runtime; start.sh binds nginx to it.
CMD ["/usr/local/bin/start.sh"]
