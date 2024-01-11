# Barbara

## Nom du Projet

BARBARA

## Installation

### Prérequis

Avant de commencer, assurez-vous d'avoir les éléments suivants installés sur votre machine :

- PHP 8.2.12
- MySQL 8.0.31
- Node.js 21.4.0
- Bootstrap 5.3.2
- Bootstrap Icons 1.11.2
- Git 2.43.0.windows.1

### Étapes d'Installation

1. Clonez le dépôt vers votre machine locale :

    ```bash
    git clone https://github.com/kevd3r/barbara.git
    ```

2. Accédez au répertoire du projet :

    ```bash
    cd barbara
    ```

3. Installez les dépendances Node.js :

    ```bash
    npm install
    ```

4. Copiez le fichier de configuration dans le répertoire `lib` :

   - Soit en ligne de commande :

     ```bash
     cp /lib/config.php
     ```

   - Soit créez directement depuis votre éditeur de code un fichier `config.php` dans le répertoire `lib` et collez-y le texte suivant :

     ```php
     <?php
     // Constantes de connexion à la base de données
     define('DB_HOST', 'localhost');
     define('DB_NAME', 'nom_de_votre_base_de_donnees');
     define('DB_USER', 'nom_utilisateur_database');
     define('DB_PASSWORD', 'mot_de_passe_database');

     // Ajoutez des constantes pour les chemins relatifs
     define('_ASSETS_IMAGE_FOLDER_', "/assets/images/");
     define('_EVENTS_IMAGES_FOLDER_','/uploads/');
     define('_HOME_EVENTS_LIMIT_', 3); // Nombre d'articles à afficher sur la page d'accueil
     define("_DOMAIN_", ".supercode"); // Nom de domaine pour le cookie de session
     define('_ADMIN_ITEMS_PER_PAGE_', 10); // Nombre max d'évènements par page dans l'interface admin
     ```

5. Importez la base de données expurgée dans phpMyAdmin.

## Utilisation

Pour utiliser l'application, lancez Wamp et accédez à http://localhost.

## Licence

Texte intégral de la licence MIT.

## Auteur

Kevin Derot est l'auteur de ce code.
