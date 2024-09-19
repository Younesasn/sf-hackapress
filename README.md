# Welcome to Hacka'Press 🧺

![image](<https://img.shields.io/badge/Symfony-000000?style=for-the-badge&logo=Symfony&logoColor=white>)

Un site de pressing pour les vêtements de qualité et de performance.

Ce projet est le back-end API d'[Hacka'Press](<https://hackapress.you-dev.fr>). Pour la partie front-end, voir [ng-hackapress](<https://github.com/Younesasn/ng-hackapress.git>).

## Configuration ⚙️

Installer le projet avec `Composer` :
```bash
composer install
```

### Doctrine 🪄

Créer un fichier `.env.local` à la racine du projet & configurer votre `base de donnée` :
```ini
DATABASE_URL="mysql://username:password@127.0.0.1:port/db_name?serverVersion=8.0.32&charset=utf8mb4"
```

Lancez les commandes :
```bash
php bin/console doctrine:database:create
```
```bash
php bin/console doctrine:migrations:migrate
```

Voici un [schéma représentatif](<bdd.png>) de la base de donnée du projet.

### Lexik 📝

Générez les clés publique et privée :

```bash
php bin/console lexik:jwt:generate-keypair
```

### Fixtures 🚧

Enfin, chargez les fixtures dans la base de donnée :
```bash
php bin/console doctrine:fixtures:load
```