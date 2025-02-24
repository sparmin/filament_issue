#!/bin/bash

# Verzeichnis des Skripts ermitteln und in dieses Verzeichnis wechseln
cd "$(dirname "$0")"

# Befehl zum Bereinigen von Backups ausführen
php artisan backup:clean

# Befehl zum Erstellen eines neuen Backups ausführen
php artisan backup:run
