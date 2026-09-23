# ============================================================
# theREFINEnetwork Enneagram assessment — Railway deploy image
# Laravel 6 / PHP 7.4 + Postgres (Supabase), nginx + php-fpm.
#
# NOTE: front-end assets are PRE-BUILT and committed under public/
# (js, css, mix-manifest.json). We deliberately do NOT run Node in
# this image — Railway's builder OOM-killed `npm ci` (exit 137).
# To change front-end assets, rebuild locally and commit the result:
#     npm ci
#     NODE_OPTIONS=--openssl-legacy-provider npm run prod
# ============================================================

FROM php:7.4-fpm-bullseye

# System libs + the PHP extensions Laravel 6 + Postgres need.
# Wipe the base image's stale apt index first (it's EOL/frozen, so the
# cached versions 404 on the mirror), refresh it, and retry flaky fetches.
RUN set -eux; \
    echo 'Acquire::Retries "5"; Acquire::http::Timeout "30";' > /etc/apt/apt.conf.d/80-retries; \
    rm -rf /var/lib/apt/lists/*; \
    apt-get update; \
    apt-get install -y --no-install-recommends --fix-missing \
        nginx libpq-dev libonig-dev libzip-dev unzip git; \
    docker-php-ext-install pdo pdo_pgsql pgsql mbstring bcmath zip; \
    apt-get clean; \
    rm -rf /var/lib/apt/lists/*

# Composer (copied from the official image).
COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

WORKDIR /var/www/html

# App source — includes the pre-built public/ assets.
COPY . .

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
