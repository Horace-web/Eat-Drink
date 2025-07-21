#!/usr/bin/env bash

# Installer PHP et les dépendances (Render le fait automatiquement)
composer install --no-dev --optimize-autoloader

# Générer la clé d'application si nécessaire
if [ -z "$APP_KEY" ]; then
  php artisan key:generate
fi

# Configurer le cache
php artisan config:cache
php artisan route:cache
php artisan view:cache

# Définir les permissions
chmod -R 775 storage bootstrap/cache