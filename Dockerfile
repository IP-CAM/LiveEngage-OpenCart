FROM vimagick/opencart
RUN apt-get update && apt-get install openssl libssl-dev && docker-php-ext-install ftp
#RUN yes | pecl install xdebug
#COPY docker-config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

#EXPOSE 9000