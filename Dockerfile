FROM php:7.2.34-cli-alpine
WORKDIR /var/www/html
COPY ./composer.json ./composer.json
COPY ./composer.phar ./composer.phar
RUN docker-php-ext-install pdo pdo_mysql
RUN php composer.phar install
CMD php -S 0.0.0.0:8000
EXPOSE 8000
