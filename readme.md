# Karto
Outil de cartographie pour Yapaka.be

# Installation

- git clone https://github.com/philippejadin/karto.git
- composer install 
- cp .env.example .env
- php artisan key:generate

Modifier le fichier .env et mettre le sinfos de connexion à la base de donnée

- php artisan db:migrate
- php artisan serve 



# License
GPL v3
