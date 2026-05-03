FROM php:8.1-apache

# Install mysqli
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Fix MPM & enable rewrite
RUN apt-get update \
    && apt-get install -y libapache2-mod-php8.1 2>/dev/null || true \
    && rm -rf /var/lib/apt/lists/* \
    && a2dismod mpm_event 2>/dev/null || true \
    && a2enmod mpm_prefork rewrite

# Virtual host
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/000-default.conf

WORKDIR /var/www/html
COPY . .

RUN mkdir -p upload/images \
    && chmod -R 775 upload \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80