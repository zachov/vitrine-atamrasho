# Utilise l'image officielle PHP avec serveur intégré
FROM php:8.2-apache

# Copie ton site dans le conteneur
COPY . /var/www/html/

# Active mod_rewrite si besoin pour tes routes propres
RUN a2enmod rewrite

# Expose le port web
EXPOSE 80

# Lance Apache (Render détecte ce port automatiquement)
CMD ["apache2-foreground"]
