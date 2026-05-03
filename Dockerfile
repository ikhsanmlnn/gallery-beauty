FROM php:8.1-apache

# Fix MPM conflict
RUN a2dismod mpm_event mpm_worker 2>/dev/null || true \
    && a2enmod mpm_prefork rewrite

# Install PHP MySQL extension
RUN docker-php-ext-install mysqli pdo pdo_mysql

WORKDIR /var/www/html

COPY . .

# Permissions for upload folder
RUN mkdir -p /var/www/html/upload/images \
    && chmod -R 775 /var/www/html/upload \
    && chown -R www-data:www-data /var/www/html/upload

# Allow .htaccess
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/override.conf \
    && a2enconf override

EXPOSE 80