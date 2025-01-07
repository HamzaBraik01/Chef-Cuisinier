# Site Web pour un Chef Cuisinier Mondialement Reconnu  

## Contexte du Projet  
Ce projet consiste à développer un site web pour un chef cuisinier mondialement reconnu, offrant une expérience gastronomique unique. Les utilisateurs peuvent :  
- Découvrir des menus exclusifs.  
- Réserver des expériences culinaires à domicile.  
- Interagir avec le chef.  

## Objectifs du Projet  

### Site Web avec Multi-Rôles  

#### Utilisateurs (Clients)  
- Découvrir les menus proposés par le chef.  
- S’inscrire, se connecter, et réserver une expérience culinaire.  

#### Chefs (Administrateurs)  
- Se connecter et gérer les réservations :  
  - Accepter, refuser, ou consulter les demandes.  
  - Visualiser les statistiques des réservations.  
  - Gérer leur profil.  

### Fonctionnalités Principales  

#### Inscription et Connexion  
- Authentification pour les utilisateurs et chefs.  
- Redirection vers des pages spécifiques selon leur rôle.  

#### Page Utilisateur (Client)  
- Consultation des menus et réservation d'une expérience culinaire.  
- Gestion des réservations :  
  - Historique, modification, ou annulation.  

#### Page Chef (Dashboard)  
- Gestion des réservations :  
  - Accepter ou refuser les demandes selon la disponibilité.  
- Statistiques détaillées :  
  - Nombre de demandes en attente.  
  - Nombre de demandes approuvées pour aujourd'hui et demain.  
  - Détails du prochain client et de sa réservation.  
  - Nombre de clients inscrits.  

#### Design  
- **Responsive Design** : Compatibilité avec mobile, tablette et desktop.  
- **Esthétique** : Design moderne et élégant pour représenter le luxe.  
- **UX/UI** : Interface intuitive pour une navigation fluide.  

### Fonctionnalités JavaScript  

#### Validation des Formulaires avec Regex  
- Validation des champs utilisateur (email, téléphone, mot de passe, etc.).  

#### Formulaires Dynamiques d’Ajout de Menus  
- Ajout ou suppression dynamique de champs pour permettre l'insertion de multiples plats.  

#### Modals Dynamiques  
- Affichage d'informations via modals sans recharger la page.  

#### SweetAlerts  
- Alertes élégantes pour des actions importantes (confirmation, annulation, erreurs).  

### Sécurité des Données  

#### Hashage des Mots de Passe  
- Hashage sécurisé pour protéger les mots de passe.  

#### Protection contre les Failles XSS  
- Nettoyage et échappement des entrées utilisateur.  

#### Prévention des Injections SQL  
- Utilisation de requêtes préparées.  

#### Protection contre les Attaques CSRF (Bonus)  
- Implémentation d'un token CSRF pour sécuriser les actions sensibles.  

## Diagrammes  
Les diagrammes représentant les cas d’utilisation, les classes, et l’architecture globale du projet se trouvent dans le fichier `diagrammes.pdf`.  

## Commandes SQL  
Les commandes SQL nécessaires à la création et à la gestion de la base de données (création de tables, insertion de données) sont disponibles dans le fichier `database.sql`.  

## Installation et Lancement  

1. Clonez ce repository :  
   ```bash
   git clone https://github.com/HamzaBraik01/Chef-Cuisinier

