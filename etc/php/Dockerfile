FROM php:7.2-fpm

WORKDIR '/var/www/html'
COPY ./web/ /var/www/html/

RUN apt-get update
RUN apt-get install -y \
curl \
wget \
git

RUN docker-php-ext-install pdo_mysql

RUN curl -sS https://getcomposer.org/installer | php -- --install-dir=/usr/local/bin --filename=composer
RUN echo "alias phinx='php src/vendor/bin/phinx'" >> ~/.bashrc
RUN chown -R www-data:www-data /var/www/html

ENTRYPOINT ["php-fpm"]