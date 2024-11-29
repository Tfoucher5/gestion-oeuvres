# **Gestion des Œuvres**

## Description
**Gestion Œuvres** est une application web développée en Laravel permettant de gérer une collection d'œuvres artistiques. Ce projet offre des fonctionnalités pour ajouter, modifier, supprimer et consulter des œuvres, tout en gérant les ventes associées (seulement pour les commissaires-priseur) et en fournissant des statistiques utiles.

## Fonctionnalités
- **Gestion des œuvres :**
  - Ajout d'œuvres avec photo, descriptif, année de création, catégorie, époque, et valeur.
  - Modification et suppression des œuvres existantes.
  - Affichage détaillé des informations d'une œuvre.
  
- **Suivi des ventes :**
  - Association des œuvres avec des ventes.
  - Gestion des transactions et du suivi des valeurs.

- **Statistiques :**
  - Calcul de la valeur totale de la collection.
  - Calcul de la valeur de la comission pour le commissaire par vente.

- **Support multimédia :**
  - Upload et affichage d'images des œuvres.
  
- **Responsive Design :**
  - Une interface adaptée aux mobiles, tablettes et ordinateurs.
 
- **Notifications :**
      - Notifications lorsqu'une oeuvre est ajoutée à une vente.
      - Notifications lorsqu'une oeuvre à été vendue.
      - Notification pour demander l'annulation d'une vente afin de supprimer une oeuvre de notre collection

## Installation sous Homestead

### Prérequis
Avant de commencer, assurez-vous que vous avez les éléments suivants installés sur votre machine :
- **Homestead** : Un environnement de développement Laravel basé sur Vagrant.
- **VirtualBox** ou **VMware** : Logiciel de virtualisation pour exécuter Homestead.
- **Composer** : Le gestionnaire de dépendances PHP.
- **Git** : Pour cloner le dépôt du projet.

### Étapes d'installation

1. **Cloner le dépôt du projet**
   - Ouvrez votre terminal et clonez ce dépôt Git sur votre machine :
     ```bash
     git clone https://github.com/votre-utilisateur/gestion-des-oeuvres.git
     cd gestion-oeuvres
     ```

2. **Configurer Homestead**
   - Si vous n'avez pas encore configuré Homestead, suivez la [documentation officielle de Laravel Homestead](https://laravel.com/docs/11.x/homestead) pour installer et configurer Homestead.
   - Une fois Homestead installé, ajoutez le dossier du projet à la configuration de votre fichier `Homestead.yaml` :
     ```yaml
     sites:
         - map: gestion-oeuvres.test
           to: /home/vagrant/code/gestion-oeuvres/public
     ```

3. **Mise à jour des dépendances**
   - Une fois Homestead configuré, ouvrez une session SSH dans votre machine virtuelle Homestead :
     ```bash
     vagrant ssh
     ```
   - Allez dans le répertoire de votre projet :
     ```bash
     cd /home/vagrant/code/gestion-oeuvres
     ```
   - Installez les dépendances du projet avec Composer :
     ```bash
     composer install
     ```

4. **Configurer l'environnement**
   - Copiez le fichier `.env.example` en `.env` :
     ```bash
     cp .env.example .env
     ```
   - Ouvrez le fichier `.env` et configurez les paramètres suivants :
     - **DB_CONNECTION=mysql**
     - **DB_HOST=127.0.0.1**
     - **DB_PORT=3306**
     - **DB_DATABASE=gestion-oeuvres**
     - **DB_USERNAME=homestead**
     - **DB_PASSWORD=secret**
   
   Vous pouvez également configurer d'autres paramètres comme le **MAIL** ou **CACHE** selon vos besoins.

5. **Exécuter les migrations et remplir la base avec des données préfabriquées **
   - Toujours dans Homestead, exécutez les migrations pour créer les tables de la base de données :
     ```bash
     php artisan migrate
     php artisan db:seed
     ```
     
6. **Générer la clé de l'application**
   - Exécutez la commande suivante pour générer la clé de l'application :
     ```bash
     php artisan key:generate
     ```

7. **Accéder à l'application**
   - Modifiez votre fichier `hosts` sur votre machine hôte (pas dans la VM) pour ajouter l'entrée suivante :
     ```bash
     192.168.10.10 gestion-des-oeuvres.test
     ```
   - Accédez à votre application via `http://gestion-des-oeuvres.test` dans votre navigateur.

### Lancer l'application
Une fois toutes les étapes précédentes terminées, vous pouvez lancer l'application. Vous devriez pouvoir voir le projet en action en accédant à l'URL configurée dans votre fichier `Homestead.yaml`.

