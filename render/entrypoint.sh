#!/bin/sh
set -e

cd /var/www/html

# 1. Render injects $PORT — render the nginx config from its template
export PORT="${PORT:-10000}"
envsubst '${PORT}' < /etc/nginx/nginx.conf.template > /etc/nginx/nginx.conf

# 2. Run migrations.
#    Supabase's pooler (port 6543) doesn't reliably support the session-level
#    operations migrations need (CREATE TABLE, etc.), so we use the direct
#    connection if MIGRATE_DB_HOST is set — otherwise fall back to DB_HOST.
echo "Running migrations…"
if [ -n "$MIGRATE_DB_HOST" ]; then
    DB_HOST="$MIGRATE_DB_HOST" DB_PORT="${MIGRATE_DB_PORT:-5432}" \
        php artisan migrate --force
else
    php artisan migrate --force
fi

# 3. Build runtime caches. Must run AFTER env injection (Render does this
#    before ENTRYPOINT), since config:cache snapshots env values.
echo "Building runtime caches…"
php artisan config:cache
php artisan route:cache
php artisan view:cache
php artisan event:cache

# 4. Hand off to supervisord, which runs php-fpm + nginx in the foreground
echo "Starting supervisord…"
exec supervisord -c /etc/supervisord.conf
