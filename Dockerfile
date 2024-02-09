FROM php:7.4-apache

#instalamos script para agregar extensiones
ADD https://github.com/mlocati/docker-php-extension-installer/releases/latest/download/install-php-extensions /usr/local/bin/

RUN chmod +x /usr/local/bin/install-php-extensions && sync && \
    install-php-extensions \
    gd \
    xdebug \
    mysqli \
    pdo_mysql \
    oci8 \
    intl \
    zip \
    pdo_oci \
    @composer
   #a2enmod rewrite && service apache2







    
    
  
    
    

