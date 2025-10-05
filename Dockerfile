# Image Apache + PHP
FROM php:8.2-apache

# Activer rewrite et .htaccess
RUN a2enmod rewrite \
 && sed -ri 's/AllowOverride None/AllowOverride All/g' /etc/apache2/apache2.conf

# Copier les sources
COPY . /var/www/html/

# Script d’entrée pour binder sur $PORT
COPY start.sh /usr/local/bin/start.sh
RUN chmod +x /usr/local/bin/start.sh

# Droits basiques
RUN chown -R www-data:www-data /var/www/html

# Informationnel (Render passera de toute façon $PORT)
EXPOSE 10000

# Lancer via notre script
CMD ["/usr/local/bin/start.sh"]
