#!/bin/sh
set -e

# Railway (and most PaaS) inject the port to listen on via $PORT.
: "${PORT:=8080}"
sed -i "s/listen 8080;/listen ${PORT};/" /etc/nginx/conf.d/default.conf

# Clear any stale caches (safe if empty); do NOT config:cache — this app
# reads env() at runtime in controllers, which config caching would break.
php artisan cache:clear  >/dev/null 2>&1 || true
php artisan view:clear   >/dev/null 2>&1 || true
php artisan route:clear  >/dev/null 2>&1 || true

# Apply any pending database migrations on deploy. --force skips the
# interactive confirmation that Laravel requires in production. Best-effort:
# a transient DB issue must not take the site down, so we still boot the app
# (the next deploy retries); a genuine migration error will surface in logs.
php artisan migrate --force || echo "WARN: 'php artisan migrate' failed; booting anyway"

# php-fpm in the background, nginx in the foreground (keeps container alive).
php-fpm -D
exec nginx -g 'daemon off;'
