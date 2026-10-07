# 📚 Tom Troc

Tom Troc est une application web développée en PHP selon une architecture MVC.
Elle permet à des utilisateurs d'échanger des livres entre eux en toute simplicité.

---

# Fonctionnalités

## Gestion des utilisateurs

- Inscription
- Connexion / Déconnexion
- Modification du profil
- Consultation du profil public d'un utilisateur

## Gestion des livres

- Ajouter un livre
- Modifier un livre
- Supprimer un livre
- Consulter un livre
- Voir tous les livres disponibles à l'échange
- Recherche par titre

## Messagerie

- Envoi de messages entre utilisateurs
- Historique des conversations

## Sécurité

- Authentification par session
- Protection contre les injections SQL grâce à PDO et aux requêtes préparées
- Vérification des autorisations avant modification ou suppression
- Validation des données utilisateurs
- Gestion d'une page d'erreur personnalisée 404

---

# Technologies utilisées

- PHP 8
- MySQL
- HTML5
- CSS3
- Architecture MVC
- PDO

---

# Structure du projet

- controllers/
- models/
- views/
- config/
- public/
- assets/


Le projet suit une architecture MVC :

- **Models** : accès aux données
- **Views** : affichage
- **Controllers** : logique métier

---

# Installation

## 1. Cloner le projet

```bash
git clone https://github.com/...
```

## 2. Créer la base de données

Importer le fichier SQL :

```
tomtroc.sql
```

## 3. Configurer la connexion

Modifier :

```
config/config.php
```

pour installer le projet il faut copier config.sample.php en config.php et renseigner ses propres identifiants.

## 4. Lancer le projet

Depuis Laragon ou Apache :

```
http://localhost/tomtroc
```

---

# Base de données

La base de données est composée principalement des tables suivantes :

- users
- books
- messages

Les relations permettent :

- un utilisateur possède plusieurs livres
- les utilisateurs peuvent échanger des messages

---

# Auteur

Sébastien Glippa

Projet réalisé dans le cadre de la formation OpenClassrooms.
