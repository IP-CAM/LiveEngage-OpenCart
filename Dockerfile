FROM vimagick/opencart

RUN yes | pecl install xdebug
COPY docker-config/xdebug.ini /usr/local/etc/php/conf.d/xdebug.ini

EXPOSE 9000