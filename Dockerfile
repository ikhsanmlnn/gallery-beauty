FROM php:8.1-apache

# Install extension MySQL untuk CodeIgniter
RUN docker-php-ext-install mysqli

# Enable mod_rewrite untuk .htaccess CodeIgniter
RUN a2enmod rewrite

# Hapus halaman default Apache
RUN rm -f /var/www/html/index.html

# Copy semua project ke web root Apache
COPY . /var/www/html/

# Permission folder
RUN chown -R www-data:www-data /var/www/html
RUN chmod -R 755 /var/www/html
RUN chmod -R 777 /var/www/html/upload

EXPOSE 80