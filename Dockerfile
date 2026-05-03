FROM php:8.1-apache

# Enable Apache mod_rewrite
RUN a2enmod rewrite

# Install PHP extensions for MySQL
RUN docker-php-ext-install mysqli pdo pdo_mysql

# Set working directory
WORKDIR /var/www/html

# Copy all project files
COPY . .

# Set upload folder permissions
RUN mkdir -p /var/www/html/upload/images \
    && chmod -R 775 /var/www/html/upload \
    && chown -R www-data:www-data /var/www/html/upload

# Apache config: allow .htaccess override
RUN echo '<Directory /var/www/html>\n\
    Options Indexes FollowSymLinks\n\
    AllowOverride All\n\
    Require all granted\n\
</Directory>' > /etc/apache2/conf-available/override.conf \
    && a2enconf override

EXPOSE 80
