# Rapport de gestion (Product Owner)

En tant que product owner de l'application Sym CRM, j'ai géré ce projet de cette manière :

## 1) Le rendez-vous avec le client

Je dois prévoir un rendez-vous avec le client afin de définir ses besoins.

Je prends ensuite des notes.

## 2) Le modèle conceptuel de données (MCD)

J'ai modélisé la base de données de l'application avec ses différents types de données, à savoir :
- les utilisateurs
- les contacts
- les événements
- les équipes

## 3) La rédaction du cahier des charges

Cette étape importante voire primordiale m'a permis de définir les besoins du client et les fonctionnalités d'une manière claire et précise.

Ce document me permettra aussi d'avoir une vision d'ensemble pour le développement de l'application.

## 4) Le diagramme de Gantt

Je définis des groupes de tâches sur un délai avec un nombre de jours et un pourcentage d'avancement.

Je me base sur :
- la conception
- les composants (menu de navigation, messages flash...)
- les pages (accueil, mentions légales...)
- la gestion des utilisateurs
- la gestion des équipes
- la gestion des événements
- la gestion des contacts

## 5) Le kanban

Je définis l'ensemble des tâches avec un kanban en 4 colonnes :
- à faire
- en cours
- à tester
- terminé

Cet outil me permet d'avoir une vision globale sur mon avancement.

## 6) La veille technologique

Je me renseigne sur les outils de développement de cette application. 

J'ai choisi :
- le langage PHP
- le framework Bulma CSS côté front-end (design)
- le framework Symfony côté back-end (serveur, en PHP)
- l'intégration de web components (composants ou balises HTML personnalisées en JS)
- l'intégration de la librairie JS Full Calendar pour le calendrier

Je fais une liste de sites et de vidéos / chaînes Youtube pour me former au besoin et adapter des parties de code.

## 7) La conception de l'interface graphique

Je commence à concevoir l'interface avec Bulma CSS afin d'avoir une vision globale au niveau du design et de l'application.

Je considère aussi cette première interface comme une maquette de base.

## 8) Les données de test

Je définis un ensemble de données de test que j'intègre dans chaque liste.

Ces mêmes données me serviront tout au long du développement du CRUD (Create Read Update Delete) et de la démonstration.

## 9) L'architecture de l'application

Je construit l'architecture globale avec des fichiers liés aux données répartis selon le modèle MVC et :
- les contrôleurs
- les entités ou modèles
- les répertoires (requêtes SQL avec les modèles)

## 10) Le développement du CRUD

Je commence le développement du CRUD par type de données dans cet ordre :
- les équipes
- les événements
- les utilisateurs
- les contacts

J'optimise ensuite le code afin de le réadapter au mieux pour les autres types de données et l'évolutivité de l'application.

## 11) Le tableau de bord

Cette partie est consacrée aux statistiques globales pour chaque utilisateur.

## 12) Le calendrier des événements

J'intègre un calendrier des événements avec FullCalendar.

## 13) L'ajout de membres à une équipe

Je développe le système d'ajout dynamique de membres à une équipe.

## 14) Le système d'authentification

J'intègre le système d'authentification de Symfony avec :
- l'inscription d'un nouvel utilisateur
- la connexion
- la déconnexion
- l'envoi d'un nouveau mot de passe

## 15) Le profil de l'utilisateur

Je considère cette partie comme la suite de l'authentification.

## 16) La gestion des rôles

Je développe ensuite le système de rôles avec les accès aux pages et les actions autorisées.

## 17) L'ajout et l'amélioration de fonctionnalités

Je peux ajouter des fonctionnalités à la demande du client et en améliorer certaines.