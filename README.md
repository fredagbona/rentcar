# Instructions pour lancer le projet

## Faire les configurations suivantes

- `Modifier le fichier .env pour l'adapter à son environnement local`
- `Démarrer votre base de données MySQL`

## Lancer les commandes suivantes

- `composer update && npm install`
- `php artisan storage:link`
- `php artisan key:generate`
- `php artisan migrate --seed`
- `npm run build && php artisan serve`

## Informations de connexion de l'administrateur

Mail : fred@gmail.com
Password : password


## Notice
S'il arrive que vous modifiez le code source du projet et que vous aimeriez voir le changement, exécutez `npm run dev` au lieu `npm run build` dans un terminal.

