FROM ubuntu:22.04

ENV DEBIAN_FRONTEND=noninteractive

RUN apt-get update && apt-get install -y \
    apache2 \
    php8.1 \
    php8.1-mysqli \
    php8.1-pdo \
    libapache2-mod-php8.1 \
    && rm -rf /var/lib/apt/lists/*

# Disable default site, enable rewrite
RUN a2dissite 000-default \
    && a2enmod rewrite php8.1

# Buat virtual host config baru
RUN echo '<VirtualHost *:80>\n\
    DocumentRoot /var/www/html\n\
    <Directory /var/www/html>\n\
        Options Indexes FollowSymLinks\n\
        AllowOverride All\n\
        Require all granted\n\
    </Directory>\n\
</VirtualHost>' > /etc/apache2/sites-available/gallery.conf \
    && a2ensite gallery

# Hapus default html
RUN rm -rf /var/www/html/*

WORKDIR /var/www/html
COPY . .

RUN mkdir -p upload/images \
    && chmod -R 775 upload \
    && chown -R www-data:www-data /var/www/html

EXPOSE 80
CMD ["apache2ctl", "-D", "FOREGROUND"]