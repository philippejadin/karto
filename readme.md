# Karto
Outil de cartographie pour Yapaka.be visible sur http://cartographie.yapaka.be

Cet outil est librement utilisable par d'autres structures et services qui souhaitent mettre en place un outil de cartographie performant.

# Fonctionalités

Pour les administrateurs:
- import de contacts à partir de fichier xls ou csv
- géolocalisation
- taggage (catégorisation) libre
- interface crud (create, read, update, delete) permettantde modifier les contacts et les tags
- interface de modification en masse des tags
- notion de tag principaux et de tags secondaires pour une classification plus fine de vos contacts
- recherche des doublons
- géolocalisation en tâche de fond par cron

Pour les utilisateurs finaux (visiteurs du site) :
- outil de recherche par géolocalisation (recherche à x km d'une adresse)
- affichage sur carte
- affichage dynamique pour chaque catégorie principale

# System requirements
- php 5.6 +
- mysql
- voir les system requirements de Laravel (https://laravel.com/docs/5.2#server-requirements)

# Installation

- git clone https://github.com/philippejadin/karto.git
- cd karto
- composer install
- cp .env.example .env
- php artisan key:generate

Modifier le fichier .env et mettre les infos de connexion à la base de donnée

- php artisan db:migrate

Pour lancer un serveur de test (facultatif - pas pour la production)
- php artisan serve

Configurez votre serveur web pour servir le dossier **public**
-> c'est très important pour la sécurité

Le premier utilisateur créé sera administrateur
- créez un premier utilisateur tout de suite


# Mises à jour
La branche master est toujours stable (principe des rolling releases)

- cd karto
- php artisan down
- git pull
- composer install
- php artisan migrate (répondez yes)
- php artisan up

# Auteurs
Philippe Jadin ainsi que Lilian Bolly Barajas et Soungui Issaka dans le cadre de leur stage web developper (merci à eux 2!).
Ainsi que les personnes mentionnées ici : https://github.com/philippejadin/karto/graphs/contributors

# License
GPL v3 ou ultérieure
