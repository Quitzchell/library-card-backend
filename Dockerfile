# syntax=docker/dockerfile:1.7

# ============================================================
# Stage 1: composer dependencies (production only)
# ============================================================
FROM composer:2 AS vendor
WORKDIR /app
COPY src/composer.json src/composer.lock ./
RUN composer install \
    --no-dev \
    --no-scripts \
    --no-autoloader \
    --prefer-dist \
    --no-progress \
    --no-interaction

# ============================================================
# Stage 2: front-end assets (Vite + Tailwind 4)
# ============================================================
FROM node:22-alpine AS assets
WORKDIR /app
COPY src/package.json src/package-lock.json ./
RUN npm ci --no-audit --no-fund
COPY src/ ./
COPY --from=vendor /app/vendor ./vendor
RUN npm run build

# ============================================================
# Stage 3: production runtime (PHP-FPM + nginx + supervisor)
# ============================================================
FROM php:8.5-fpm-alpine AS runtime

WORKDIR /var/www/html

# Runtime libraries (kept) + build deps (removed after install).
# Imagick handles image processing — preserves ICC colour profiles and
# converts wide-gamut sources to sRGB, which GD cannot.
RUN set -eux; \
    apk add --no-cache \
        nginx \
        supervisor \
        gettext \
        icu \
        libintl \
        libzip \
        oniguruma \
        imagemagick \
        imagemagick-jpeg \
        imagemagick-webp \
        postgresql-client \
        postgresql-libs; \
    apk add --no-cache --virtual .build-deps \
        autoconf \
        gcc \
        g++ \
        make \
        pkgconfig \
        icu-dev \
        libzip-dev \
        oniguruma-dev \
        imagemagick-dev \
        postgresql-dev; \
    for ext in pdo_pgsql intl zip bcmath pcntl; do \
        docker-php-ext-install "$ext"; \
    done; \
    pecl install imagick; \
    docker-php-ext-enable imagick; \
    apk del .build-deps; \
    rm -rf /tmp/* /var/cache/apk/*

# Production php.ini + opcache tuning
RUN cp "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" && \
    { \
        echo "memory_limit=256M"; \
        echo "upload_max_filesize=10M"; \
        echo "post_max_size=10M"; \
        echo "expose_php=Off"; \
        echo "opcache.enable=1"; \
        echo "opcache.enable_cli=0"; \
        echo "opcache.memory_consumption=128"; \
        echo "opcache.interned_strings_buffer=16"; \
        echo "opcache.max_accelerated_files=10000"; \
        echo "opcache.validate_timestamps=0"; \
    } > "$PHP_INI_DIR/conf.d/zz-app.ini"

# Composer is needed once at build-time to optimize the autoloader and run
# Laravel's post-autoload-dump scripts (package:discover, filament:upgrade).
COPY --from=composer:2 /usr/bin/composer /usr/local/bin/composer

# App source, vendored deps from stage 1, built front-end from stage 2
COPY src/ ./
COPY --from=vendor /app/vendor ./vendor
COPY --from=assets /app/public/build ./public/build

# Optimize autoload + run post-autoload-dump scripts (publishes Filament
# assets, builds package manifest). Then drop stale runtime caches that
# may have been copied from src/ — entrypoint will rebuild them.
RUN composer dump-autoload --optimize --no-dev && \
    rm -f bootstrap/cache/config.php \
          bootstrap/cache/routes-v7.php \
          bootstrap/cache/events.php && \
    rm -f /usr/local/bin/composer

# PHP-FPM runs as www-data; needs write to storage + cache
RUN chown -R www-data:www-data storage bootstrap/cache && \
    chmod -R ug+rwx storage bootstrap/cache

# Render-specific: nginx (templated for $PORT), supervisord, entrypoint
COPY render/nginx.conf.template /etc/nginx/nginx.conf.template
COPY render/supervisord.conf /etc/supervisord.conf
COPY render/entrypoint.sh /usr/local/bin/entrypoint.sh
RUN chmod +x /usr/local/bin/entrypoint.sh

# Render injects PORT (free tier defaults to 10000)
ENV PORT=10000
EXPOSE 10000

ENTRYPOINT ["/usr/local/bin/entrypoint.sh"]
