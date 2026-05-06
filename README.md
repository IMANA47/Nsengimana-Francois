# Portfolio Full Stack Engineer

Portfolio professionnel Laravel 13 + Bootstrap 5, orienté business, avec architecture modulaire simple pour ajouter de nouvelles sections.

## Installation

1. Installer les dependances:
   - `php -c ../composer-php.ini ../composer.phar install`
   - `npm install`
2. Configurer `.env` (DB MySQL).
3. Generer la cle:
   - `php artisan key:generate`
4. Migrer + seed:   
- `php artisan migrate:fresh --seed`

5. Lancer:
   - `php artisan serve`
   - `npm run dev`

## Auth admin

- Breeze est installe.
- Compte seed:
  - Email: `admin@portfolio.test`
  - Password: `password`

## Structure principale

- `app/Http/Controllers`: controllers home/contact/admin CRUD
- `app/Services/SectionManager.php`: resolution des sections actives
- `app/Models`: entites Portfolio
- `database/migrations`: schema
- `database/factories`: fake data
- `resources/views/home.blade.php`: landing page publique
- `resources/views/sections/*.blade.php`: sections modulaires injectees dynamiquement
- `resources/views/admin/*`: gestion Projects / Certificates / Testimonials / Messages
- `config/portfolio.php`: profil + sections dynamiques activables

## Ajouter une nouvelle section

1. Creer la vue section dans `resources/views/sections/<nom>.blade.php`.
2. Ajouter la section dans `config/portfolio.php` (`key`, `title`, `view`, `enabled`).
3. Si besoin de donnees, les charger dans `HomeController`.
4. Le rendu est automatique via la boucle de sections dans la home.

## MySQL

- `.env` est preconfigure en MySQL:
  - `DB_CONNECTION=mysql`
  - `DB_HOST=127.0.0.1`
  - `DB_PORT=3306`
  - `DB_DATABASE=portfolio`
  - `DB_USERNAME=root`
  - `DB_PASSWORD=...`
- Lance ensuite:
  - `php -c ../composer-php.ini artisan migrate:fresh --seed`
## Chatbot

- Le chatbot est dans `resources/views/home.blade.php`.
- Reponses FAQ dans l'objet JS `answers`.
- Pour evolution IA:
  - Remplacer la logique locale par un appel API (route Laravel + service).

## Notes

- Upload fichiers via disque `public` (`storage:link` recommande).
- Bouton WhatsApp flottant visible sur la home.
