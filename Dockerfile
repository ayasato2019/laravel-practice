# PHP 8.2を使用
FROM php:8.2-fpm

# 必要な依存関係やライブラリをインストール
RUN apt-get update && apt-get install -y \
    libpng-dev \
    libjpeg-dev \
    libfreetype6-dev \
    libzip-dev \
    unzip \
    git \
    && docker-php-ext-configure gd --with-freetype --with-jpeg \
    && docker-php-ext-install gd zip pdo pdo_mysql

# Composerをインストール
COPY --from=composer:latest /usr/bin/composer /usr/local/bin/composer

# 作業ディレクトリを設定
WORKDIR /var/www

# アプリケーションのファイルをコピー
COPY . .

# 権限の設定 (必要に応じて)
RUN chown -R www-data:www-data /var/www

# Composerで依存関係をインストール
RUN composer install --no-interaction --prefer-dist

# Laravelの開発サーバーを起動 (php artisan serve)
CMD ["php", "artisan", "serve", "--host=0.0.0.0", "--port=8000"]
