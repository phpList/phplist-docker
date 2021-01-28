FROM php:7.4-fpm-alpine

ENV PHPLIST_VERSION 3.6.0
COPY assets/ /tmp/assets

# Use the default production configuration
RUN mv "$PHP_INI_DIR/php.ini-production" "$PHP_INI_DIR/php.ini" \
    # avoid warning due to non up-to-date packages
 && apk update \
    # rsync + imap + gd installation
    # imap: imap, openssl, imap-dev, openssl-dev
    # gd: libjpeg-turbo, libpng, libzip, libjpeg-turbo-dev, libpng-dev, libzip-dev
    #    libpng, libjpeg-turbo, and libzip explicitely installed to avoid removal with -dev later
    #    you can add libwebp libxpm libwebp-dev libxpm-dev if needed
    # zip: libzip libzip-dev
 && apk add --no-cache rsync libjpeg-turbo libpng freetype imap openssl libzip libjpeg-turbo-dev libpng-dev freetype-dev imap-dev openssl-dev libzip-dev \
    # If you added webp and xpm, add also --with-webp-dir --with-xpm-dir
 && docker-php-ext-configure gd --enable-gd --with-jpeg --with-freetype \
 && docker-php-ext-configure imap --with-imap --with-imap-ssl \
 && docker-php-ext-install mysqli pdo_mysql gd imap zip \
    # do not remove imap-dev otherwise imap.so cannot be loaded
&& apk del libjpeg-turbo-dev libpng-dev freetype-dev openssl-dev libzip-dev \
 && wget -O /tmp/phplist-${PHPLIST_VERSION}.tgz https://sourceforge.net/projects/phplist/files/phplist/${PHPLIST_VERSION}/phplist-${PHPLIST_VERSION}.tgz \
 && mkdir /usr/src/phplist \
 && cd /usr/src/phplist \
 && tar -xzf /tmp/phplist-${PHPLIST_VERSION}.tgz \
 && mv phplist-${PHPLIST_VERSION}/public_html/lists lists \
 && cp lists/config/config.php lists/config/config_default.php \
 && cp lists/config/config_extended.php lists/config/config_extended_default.php \
 && cp /tmp/assets/docker-php-entrypoint-custom /usr/local/bin \
 && chmod 755 /usr/local/bin/docker-php-entrypoint-custom \
 && mv /tmp/assets/config/* lists/config/ \
 && chmod 600 lists/config/* \
 && chown www-data:root /usr/src/phplist \
    # reduce image size
 && rm -rf /tmp/* \
 && rm -rf /var/cache/apk/*


ENTRYPOINT ["docker-php-entrypoint-custom"]
CMD ["php-fpm"]

