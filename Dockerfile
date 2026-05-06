FROM node:22-bookworm AS assets

WORKDIR /app

COPY package.json ./
RUN npm install

COPY resources ./resources
COPY public ./public
COPY vite.config.js ./
RUN npm run build

FROM php:8.3-cli-bookworm

WORKDIR /var/www/html

RUN apt-get update \
    && apt-get install -y --no-install-recommends \
        git \
        unzip \
        libpq-dev \
        libzip-dev \
    && docker-php-ext-install \
        pdo_pgsql \
        zip \
    && rm -rf /var/lib/apt/lists/*

COPY --from=composer:2 /usr/bin/composer /usr/bin/composer

COPY composer.json composer.lock ./
RUN composer install \
    --no-dev \
    --prefer-dist \
    --no-interaction \
    --no-progress \
    --no-scripts \
    --optimize-autoloader

COPY . .
COPY --from=assets /app/public/build ./public/build
COPY docker/start.sh /usr/local/bin/start.sh

RUN composer dump-autoload --optimize \
    && php artisan package:discover --ansi \
    && chmod +x /usr/local/bin/start.sh \
    && chown -R www-data:www-data storage bootstrap/cache

EXPOSE 10000

CMD ["/usr/local/bin/start.sh"]
