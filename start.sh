#!/bin/sh
# start.sh — bind Apache sur le port attendu par Render ($PORT)
: "${PORT:=10000}"

# Force "Listen PORT" dans la conf Apache
sed -ri "s/^[#\s]*Listen .*/Listen ${PORT}/" /etc/apache2/ports.conf

# Optionnel mais recommandé si tu utilises .htaccess
a2enmod rewrite >/dev/null 2>&1 || true
sed -ri 's/AllowOverride\s+None/AllowOverride All/g' /etc/apache2/apache2.conf

# Démarre Apache en premier plan
exec apache2-foreground
