FROM php:8.2-apache

RUN docker-php-ext-install mysqli


RUN openssl req -new -x509 -nodes -keyout /etc/ssl/private/clave-privada.key -out /etc/ssl/certs/certificado-autofirmado.crt -days 365 -subj "/C=ES/ST=BIZKAIA /L=BILBAO/O=EHU"

COPY app/conf/php.ini /usr/local/etc/php/php.ini
COPY app/conf/apache2.conf /etc/apache2/apache2.conf
COPY app/conf/https.conf /etc/apache2/sites-available/https.conf


# Establecer permisos en archivos y directorios
RUN chmod 644 /etc/apache2/sites-available/https.conf
RUN chmod 600 /etc/ssl/certs/certificado-autofirmado.crt
RUN chmod 600 /etc/ssl/private/clave-privada.key

RUN a2enmod rewrite headers ssl
RUN a2ensite https.conf
