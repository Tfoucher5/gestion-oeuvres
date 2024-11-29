
# **Gestion des Œuvres**

## Description
**Gestion des Œuvres** est une application web développée en Laravel permettant de gérer une collection d'œuvres artistiques. Ce projet offre des fonctionnalités pour ajouter, modifier, supprimer et consulter des œuvres, tout en gérant les ventes associées et en fournissant des statistiques utiles.

## Fonctionnalités
- **Gestion des œuvres :**
  - Ajout d'œuvres avec photo, descriptif, année de création, catégorie, style, et valeur.
  - Modification et suppression des œuvres existantes.
  - Affichage détaillé des informations d'une œuvre.
  
- **Suivi des ventes :**
  - Association des œuvres avec des ventes.
  - Gestion des transactions et du suivi des valeurs.

- **Statistiques :**
  - Analyse des tendances de vente.
  - Calcul de la valeur totale de la collection.

- **Support multimédia :**
  - Upload et affichage d'images des œuvres.
  
- **Responsive Design :**
  - Une interface adaptée aux mobiles, tablettes et ordinateurs.

## Prérequis
- PHP 8.1 ou supérieur.
- Composer.
- MySQL 8.0 ou supérieur.
- Node.js (pour les assets front-end).
- Laravel 11.

## Installation

1. **Cloner le dépôt :**
   ```bash
   git clone https://github.com/votre-repo/gestion-oeuvres.git
   cd gestion-oeuvres
   ```

2. **Installer les dépendances backend :**
   ```bash
   composer install
   ```

3. **Installer les dépendances front-end :**
   ```bash
   npm install
   npm run build
   ```

4. **Configurer l'environnement :**
   - Copier le fichier `.env.example` en `.env` :
     ```bash
     cp .env.example .env
     ```
   - Mettre à jour les variables de connexion à la base de données :
     ```env
     DB_CONNECTION=mysql
     DB_HOST=127.0.0.1
     DB_PORT=3306
     DB_DATABASE=gestion_oeuvres
     DB_USERNAME=root
     DB_PASSWORD=motdepasse
     ```

5. **Générer la clé de l'application :**
   ```bash
   php artisan key:generate
   ```

6. **Exécuter les migrations et insérer les données initiales :**
   ```bash
   php artisan migrate --seed
   ```

7. **Démarrer le serveur de développement :**
   ```bash
   php artisan serve
   ```

## Utilisation
- Accédez à l'application en ouvrant [http://localhost:8000](http://localhost:8000) dans votre navigateur.
- Connectez-vous avec les identifiants par défaut (si un système d'authentification est implémenté).

## Technologies utilisées
- **Backend :** Laravel 11.
- **Frontend :** Bootstrap 5.
- **Base de données :** MySQL.
- **Gestion des rôles et permissions :** Bouncer.
- **Stockage des fichiers :** Système de fichiers Laravel.

## Fonctionnalités futures
- Système d'authentification pour les utilisateurs.
- Téléchargement de rapports PDF pour les ventes et les statistiques.
- Notifications pour les transactions ou modifications importantes.

## Contribution
Les contributions sont les bienvenues ! Suivez les étapes ci-dessous pour participer :
1. Forkez le projet.
2. Créez une branche pour votre fonctionnalité (`git checkout -b feature/ma-fonctionnalite`).
3. Commitez vos changements (`git commit -m 'Ajout d'une nouvelle fonctionnalité'`).
4. Poussez votre branche (`git push origin feature/ma-fonctionnalite`).
5. Ouvrez une Pull Request.

## Licence
Ce projet est sous licence MIT. Consultez le fichier [LICENSE](LICENSE) pour plus de détails.

## Auteur
- **Votre Nom** - Développeur Laravel et créateur de ce projet.
