FROM mcr.microsoft.com/devcontainers/php:1-8.3-bookworm

USER root

# The base image's Yarn repository is architecture-specific and can have an
# expired signing key. PHP development here does not require Yarn.
RUN rm -f /etc/apt/sources.list.d/yarn.list \
    && apt-get update \
    && apt-get install -y --no-install-recommends \
        libfreetype6-dev \
        libjpeg62-turbo-dev \
        libpng-dev \
        libzip-dev \
        nodejs \
        npm \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install -j"$(nproc)" gd pdo_mysql zip \
    && pecl install igbinary redis \
    && docker-php-ext-enable igbinary redis \
    && npm install --global intelephense \
    && rm -rf /var/lib/apt/lists/*

USER vscode
