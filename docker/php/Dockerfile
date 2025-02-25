FROM php:8.3-fpm

RUN apt update && apt install -y \
    zlib1g-dev g++ git libicu-dev zip libzip-dev unzip curl

# Install Node.js and Yarn
RUN curl -fsSL https://deb.nodesource.com/setup_18.x | bash - \
    && apt install -y nodejs

RUN npm install -g yarn

# Install PHP extensions
RUN pecl install apcu \
    && docker-php-ext-enable apcu \
    && docker-php-ext-configure zip \
    && docker-php-ext-install zip

# Install Composer
COPY --from=composer:2.6 /usr/bin/composer /usr/bin/composer

# Set working directory
WORKDIR /var/www

COPY package.json yarn.lock* composer.json composer.lock* ./
RUN yarn install
RUN composer install --no-scripts --no-interaction

COPY . .

RUN yarn encore dev

EXPOSE 9000

CMD ["php-fpm"]
