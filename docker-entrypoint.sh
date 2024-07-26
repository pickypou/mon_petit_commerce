#!/bin/bash

# Installer les dépendances
composer install

# Appliquer les migrations
php bin/console doctrine:migrations:migrate --no-interaction

#Démarrer le serveur symfony local
echo "Starting Symfony server..."
symfony server:start
