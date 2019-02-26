FROM php:7.2-fpm

WORKDIR '/var/www/html'
COPY ./web /var/www/html/

RUN docker-php-ext-install pdo_mysql
RUN echo "alias phinx='php src/vendor/bin/phinx'" >> ~/.bashrc

ENTRYPOINT ["php-fpm"]