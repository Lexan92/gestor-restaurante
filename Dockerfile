FROM richarvey/nginx-php-fpm:latest

COPY . . 

#configuracion de imagen
ENV SKIP_COMPOSER 1
ENV WEBROOT /var/www/html/public
ENV PHP_ERRORS_STDERR 1
ENV RUN_SCRIPTS 1
ENV REAL_IP_HEADER 1

#configuraciones de laravel
ENV APP_ENV production
ENV APP_DEBUG false
ENV LOG_CHANNEL stderr

#permitir a composer correr como root
ENV COMPOSER_ALLOW_SUPERUSER 1

CMD [ "/start.sh" ]