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
# bullseye is EOL/frozen: its debian-security pool has version-skewed .debs
# that 404 on the mirror (only the security suite is affected; main is fine).
# Drop the security suite and install the stable versions from main instead.
# NOTE: this trades the latest security-patch revisions of these OS libs for a
# reliable build. Revisit by moving to a maintained base image down the road.
RUN set -eux; \
    sed -i '/security/d' /etc/apt/sources.list; \
    echo 'Acquire::Retries "5"; Acquire::http::Timeout "30";' > /etc/apt/apt.conf.d/80-retries; \
    rm -rf /var/lib/apt/lists/*; \
    apt-get update; \
    apt-get install -y --no-install-recommends \
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
