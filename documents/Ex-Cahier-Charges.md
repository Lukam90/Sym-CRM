<style>
.page-break {
    page-break-after: always;
    break-after: page;
}
.content-title {
    font-size: 18px;
}
.doc-main-page {
    font-size: 36px;
    margin-top: 45%;
}
</style>

<div class="doc-main-page">
<p>Dossier de Synthèse - English Learner</p>
<p>Lucien HAMM</p>
<p>17 septembre 2021</p>
</div>

<div class="page-break"></div>

<div class="content-title">Table des matières</div>

[toc]

<div class="page-break"></div>

# Le cahier des charges

## Les normes

### Le design responsive

Le design de l'application sera responsive, en s'adaptant à plusieurs tailles d'écran selon l'appareil d'un utilisateur (ordinateur, smartphone, tablette).

### La norme RGPD (Réglement Général de la Protection des Données)

Cette norme a pour but de responsabiliser les organismes traitant des données personnelles.

C'est à l'origine une directive européenne, transposée en 2018 en droit français.

Elle permet d’encadrer le traitement et la circulation des données à caractère personnel sur le territoire européen.

Ce règlement est obligatoire, et indique que les données personnelles doivent être :
- traitées de manière licite, loyale et transparente
- collectées à des fins déterminées, explicites et légitimes
- adéquates, pertinentes et limitées
- exactes et tenues à jour
- conservées pendant une durée raisonnable
- traitées de façon à garantir leur protection

Il est donc nécessaire de :
- définir une personne chargée de la protection des données (l'administrateur)
- lister les données et leur utilité
- repérer les données à risques et les protéger
- respecter le droit des utilisateurs concernant la collecte de leurs données, leur modification et leur suppression
- s’assurer que les sous-traitants respectent la norme RGPD

Dans le cas de cette application, les éléments suivants seront à prévoir :
- une page de **Mentions Légales** rappelant à l'utilisateur ses droits concernant ses données, leur édition et leur suppression
- une page de **Politique de Confidentialité**
- la récolte d'informations essentielles et pertinentes pour un utilisateur, à savoir son pseudo et son adresse e-mail
- la sécurisation d'un mot de passe utilisateur avec une méthode de hachage
- un message d'information sur l'utilisation des cookies avec un bouton de validation

### La sécurité

L'application veillera à respecter certains principes de sécurité en incluant :
- des protections contre certaines failles (XSS, CSRF, DDoS, injections SQL...)
- un système de rôles (utilisateur, modérateur, administrateur) permettant un accès à certaines pages et fonctionnalités
- un système de hachage des mots de passe
- un système de vérification d'identité, permettant à un seul utilisateur d'accéder à ses données (consultation de profil, modification et suppression des suggestions et identifiants)
- une page de redirection en cas d'adresse invalide (erreur 404)

## Les éléments graphiques de base

**Base** : base.html.twig

### Le menu de navigation

**Vue** : partials/navbar.html.twig

Un menu de navigation du site est visible tout en haut de chaque page et contient :
- le titre English Learner tout à gauche, avec un lien vers la page d'accueil
- les liens des différentes pages à droite dans cet ordre :
    - Inscription (si non connecté)
    - Connexion (si non connecté)
    - l'adresse e-mail d'un utilisateur connecté, avec un lien vers sa page de profil
    - Déconnexion (si connecté)
    - Communauté (liste des utilisateurs)
    - Listes (liste des thèmes)

### Le pied de page

**Vue** : partials/footer.html.twig

Un pied de page est visible tout en bas de chaque page avec la mention English Learner &copy; 2021 et des liens vers les pages : 
- des **Mentions Légales**.
- de la **Politique de Confidentialité**

### Les messages d'alerte

**Vue** : partials/messages.html.twig

Les messages d'alerte (ou flash) s'affichent pour valider une action ou notifier une erreur comme :
- la confirmation d'une (dé)connexion
- un champ non valide dans un formulaire
- l'ajout d'un nouveau thème

## La page d'accueil

**Route** : / (**home**)

**Vue** : home.html.twig

**Contrôleur** : HomeController (index)

Il s'agit de la page principale, qui sert aussi de page d'affichage de statistiques avec :
- le nombre d'utilisateurs
- le nombre de thèmes
- le nombre d'expressions

Les statistiques sont affichées en blocs sur une même ligne.

Le premier bloc contient un lien vers la liste des utilisateurs.

Les autres blocs contiennent un lien vers la liste des thèmes.

## La gestion des utilisateurs

### L'inscription d'un nouvel utilisateur

**Route** : /users/register

**Vue** : users/register.html.twig

**Contrôleur** : UserController (register)

**Rôle** : invité

Un utilisateur doit s'inscrire s'il souhaite contribuer à la base de vocabulaire.

Il devra indiquer :
- son pseudo (requis, unique, alphanumérique, espaces inclus, sans accents, de 2 à 32 caractères)
- son adresse e-mail (requis, unique, e-mail valide, 100 caractères max)
- son mot de passe (requis, 8 à 32 caractères alphanumériques, avec au moins une minuscule, une majuscule et un chiffre)
- sa confirmation du mot de passe

Des messages d'erreur s'afficheront en-dessous de chaque champ mal renseigné.

**Améliorations**

La validation du formulaire se fait en temps réel avec des messages indiquant les règles de validation de chaque champ.

Un mot de passe peut comporter des caractères spéciaux ($, @, !, ?).

Le formulaire de connexion s'affiche dans une fenêtre modale.

### La connexion d'un utilisateur

**Route** : /users/login

**Vue** : users/login.html.twig

**Contrôleur** : UserController (login)

**Rôle** : invité

Un utilisateur a le droit de se connecter suivant ces conditions :
- il n'a pas été banni par un administrateur
- son compte n'a pas été supprimé

Il est invité à se connecter avec son e-mail et son mot de passe.

**Améliorations**

Le formulaire de connexion se trouve dans une fenêtre modale.

### (+) La demande d'un nouveau mot de passe

**Route** : /users/reset

**Vue** : users/reset.html.twig

**Contrôleur** : UserController (reset)

**Rôle** : invité

Un utilisateur peut demander un nouveau mot de passe si nécessaire en cliquant sur un lien **Mot de passe oublié**.

Il reçoit ensuite un e-mail avec son nouveau mot de passe.

### (+) La confirmation de la demande d'un nouveau mot de passe

**Route** : /users/confirm

**Vue** : users/confirm.html.twig

**Contrôleur** : UserController (confirm)

**Rôle** : invité

L'utilisateur est invité à cliquer sur le lien de confirmation de son e-mail indiquant son nouveau mot de passe.

Il est ensuite redirigé vers une page de confirmation de demande d'un nouveau mot de passe.

### La déconnexion d'un utilisateur

**Route** : /users/logout

**Redirection** : / (**home**)

**Contrôleur** : UserController (logout)

**Rôle** : utilisateur

Un utilisateur peut se déconnecter en cliquant sur le lien **Déconnexion** du menu de navigation.

Il est ensuite redirigé vers la page d'accueil avec un message de confirmation.

### La page profil d'un utilisateur

**Route** : /users/profile/{id}

**Vue** : users/profile.html.twig

**Contrôleur** : UserController (profile)

**Rôle** : (même) utilisateur

Un utilisateur a accès à sa page de profil en cliquant sur son pseudo dans la barre de navigation principale.

Il y retrouve son nombre de thèmes et d'expressions suggérés.

Il peut aussi modifier ses identifiants.

Un premier formulaire lui permet de changer son e-mail et son pseudo.

L'e-mail et le pseudo doivent rester uniques.

Un second formulaire lui permet de changer son mot de passe en indiquant :
- son ancien mot de passe
- son nouveau mot de passe
- la confirmation de son nouveau mot de passe

**Améliorations**

La validation des formulaires se fait en temps réel.

### La liste des utilisateurs

**Route** : /users

**Vue** : users.html.twig

**Contrôleur** : UsersController (index)

Cette page liste l'ensemble des utilisateurs sous forme de tableau avec :
- le pseudo de l'utilisateur
- le rôle de l'utilisateur (Membre, Modérateur, Administrateur, Suspendu)
- la date d'inscription, au format JJ/MM/AAAA (ex : 21/06/2021)
- le nombre de thèmes
- le nombre d'expressions
- des boutons d'édition et de suppression (administrateur)

Le pseudo de l'utilisateur sera colorié :
- en vert, si c'est un modérateur
- en rouge, si c'est un administrateur

Un message s'affiche en cas d'absence d'utilisateur inscrit.

**Améliorations**

On peut choisir l'ordre d'affichage pour chaque colonne.

Les utilisateurs sont affichés par pages avec un nombre de 50 par défaut.

On peut choisir d'afficher 10, 20, 50, 100 ou 200 utilisateurs par page.

On peut filtrer l'ensemble des utilisateurs avec une barre de recherche.

### L'édition d'un utilisateur

**Route** : /users/update/{id}

**Vue** : users/edit_user.html.twig

**Redirection** : /users

**Contrôleur** : UserController (update)

**Rôle** : administrateur

Un administrateur est redirigé vers un formulaire d'édition d'un utilisateur avec :
- le rôle de l'utilisateur (Membre, Modérateur, Administrateur)
- le statut de bannissement (case à cocher)

**Améliorations**

Le formulaire d'édition est intégré dans une fenêtre modale.

### La suppression d'un utilisateur

**Route** : /users/delete/{id}

**Vue** : users/delete_user.html.twig (*)

**Redirection** : /users

**Contrôleur** : UserController (delete)

**Rôle** : administrateur

Un administrateur est redirigé vers la page de suppression de l'utilisateur concerné.

La suppression d'un utilisateur entraîne également la suppression de l'ensemble de ses thèmes et expressions.

**Améliorations**

Un administrateur déclenche une fenêtre modale (*) de confirmation de suppression de l'utilisateur concerné.

## La gestion des thèmes

### La liste des thèmes

**Route** : /themes

**Vue** : themes.html.twig

**Contrôleur** : ThemeController (index)

Cette page liste l'ensemble des thèmes sous forme de tableau avec :
- le titre d'un thème, suivi de son lien
- l'auteur du thème
- le nombre d'expressions
- les boutons d'édition et de suppression (même utilisateur, modérateur et administrateur)

Un message s'affiche en cas d'absence de thème.

Un utilisateur connecté voit un bouton d'ajout au-dessus de la liste.

Un même utilisateur peut modifier et supprimer ses thèmes.

**Améliorations**

On peut choisir l'ordre d'affichage pour chaque colonne.

Les thèmes sont affichés par pages avec un nombre de 50 par défaut.

On peut choisir d'afficher 10, 20, 50, 100 ou 200 thèmes par page.

On peut filtrer l'ensemble des thèmes avec une barre de recherche.

### L'ajout d'un thème

**Route** : /themes/new

**Vue** : themes/new_theme.html.twig

**Redirection** : /themes

**Contrôleur** : ThemeController (create)

**Rôle** : (même) utilisateur

L'utilisateur est redirigé vers une page avec un formulaire incluant un champ pour le titre du nouveau thème.

**Améliorations**

Le formulaire d'ajout se trouve dans une fenêtre modale.

La validation du formulaire (titre obligatoire) se fait en temps réel.

### L'édition d'un thème

**Route** : /themes/edit/{id}

**Vue** : themes/edit_theme.html.twig

**Redirection** : /themes

**Contrôleur** : ThemeController (update)

**Rôle** : (même) utilisateur

Un modérateur, un administrateur ou un même utilisateur peut modifier un thème.

L'utilisateur est redirigé vers un formulaire avec un champ pré-rempli par l'ancien titre.

**Améliorations**

Le formulaire d'ajout se trouve dans une fenêtre modale.

La validation du formulaire (titre obligatoire) se fait en temps réel.

### La suppression d'un thème

**Route** : /themes/delete/{id}

**Vue** : themes/delete_theme.html.twig

**Redirection** : /themes

**Contrôleur** : ThemeController (delete)

**Rôle** : (même) utilisateur

Un modérateur, un administrateur ou un même utilisateur peut supprimer un thème.

Il est ensuite redirigé vers la page de suppression du thème.

La suppression d'un thème entraîne également la suppression de l'ensemble de ses expressions.

**Améliorations**

Une fenêtre modale s'affiche pour confirmer la suppression du thème.

## La gestion des expressions

### La liste des expressions d'un thème

**Route** : /themes/show/{id}

**Vue** : themes/show_theme.html.twig

**Contrôleur** : ThemeController (show)

Cette page liste l'ensemble des expressions d'un thème sous forme de tableau avec :
- l'expression en français
- la traduction en anglais
- la transcription phonétique
- l'auteur de l'expression
- les boutons d'édition et de suppression (modérateur, administrateur ou même utilisateur)

Un utilisateur connecté voit un bouton d'ajout au-dessus de la liste.

Un message s'affiche en cas d'absence d'expression.

**Améliorations**

On peut choisir l'ordre d'affichage pour chaque colonne.

On peut choisir d'afficher 10, 20, 50, 100 ou 200 expressions par page.

On peut aussi filtrer l'ensemble des thèmes avec une barre de recherche.

### La génération de flashcards d'un thème

**Route** : /themes/start/{id}

**Vue** : themes/game.html.twig

**Redirection** : /themes/show/{id}

**Contrôleur** : ThemeController (start)

**Rôle** : utilisateur

Un utilisateur peut lancer une partie de flashcards recto-verso sur la page d'un même thème, à partir de 10 expressions.

Il déclenche une fenêtre modale qui l'invite à choisir un niveau de difficulté qui déterminera le nombre d'expressions : facile (10), moyen (15) et difficile (20).

Il est ensuite invité à se remémorer la traduction anglaise de chaque expression affichée avant d'obtenir la réponse en un clic et de passer à la question suivante.

Les questions sont générées de manière aléatoire selon le nombre disponible et le niveau de difficulté.

La réponse est affichée avec un effet de retournement horizontal.

Une fois le jeu terminé, l'utilisateur est invité à rejouer s'il le souhaite.

### L'ajout d'une expression

**Route** : /expressions/new/{themeId}

**Vue** : expressions/new_expression.html.twig

**Redirection** : /themes/show/{id}

**Contrôleur** : ExpressionController (create)

**Rôle** : utilisateur

L'utilisateur est redirigé vers une page avec un formulaire incluant :
- un champ texte pour l'expression en français
- un champ texte pour la traduction en anglais
- un champ texte pour la transcription phonétique

**Améliorations**

Le formulaire d'ajout se trouve dans une fenêtre modale.

La validation du formulaire se fait en temps réel.

### L'édition d'une expression

**Route** : /expressions/edit/{id}

**Vue** : expressions/edit_expression.html.twig

**Redirection** : /themes/show/{id}

**Contrôleur** : ExpressionController (update)

**Rôle** : (même) utilisateur

Un modérateur, un administrateur ou un même utilisateur peut modifier une expression.

L'utilisateur est redirigé vers un formulaire incluant :
- un champ texte pré-rempli avec l'expression en français
- un champ texte pré-rempli avec la traduction en anglais
- un champ texte pré-rempli avec la transcription phonétique

**Améliorations**

Le formulaire d'édition se trouve dans une fenêtre modale.

La validation du formulaire (champs obligatoires) se fait en temps réel.

### La suppression d'une expression

**Route** : /expressions/delete/{id}

**Vue** : expressions/delete_expression.html.twig

**Redirection** : /themes/show/{id}

**Contrôleur** : ExpressionController (delete)

**Rôle** : (même) utilisateur

Un modérateur, un administrateur ou un même utilisateur peut supprimer une expression.

Il est ensuite redirigé vers la page de suppression d'une expression.

**Améliorations**

Une fenêtre modale s'affiche pour confirmer la suppression d'une expression.

# La conception

## L'interface graphique

L'application comporte plusieurs types de pages, à savoir :
- la page d'accueil
- la liste des utilisateurs
- la liste des thèmes
- la liste des expressions d'un thème
- les formulaires des utilisateurs (inscription, connexion, profil)
- les formulaires d'ajout, d'édition et de suppression

En voici quelques aperçus :

### La page d'accueil

![](images/design/page-accueil.png)

### La liste des utilisateurs

![](images/design/liste-users.png)

### La liste des thèmes

![](images/design/liste-themes.png)

### La liste des expressions d'un thème

![](images/design/liste-expressions.png)

## La base de données

La base de données de l'application est définie selon le modèle suivant :

![](images/schemas/ENL-BDD.png)

Elle se résume ainsi en trois tables :

### Les utilisateurs (users)

Un utilisateur publie aucune ou plusieurs thèmes. (0,n)

Un utilisateur publie aucune ou plusieurs expressions. (0,n)

|||
|-|-|
|**id**|l'identifiant d'un utilisateur|
|**username**|le pseudo d'un utilisateur|
|**email**|l'adresse e-mail d'un utilisateur|
|**password**|le mot de passe d'un utilisateur|
|**role**|le rôle d'un utilisateur (Membre, Modérateur, Administrateur, Suspendu)|
|**created_at**|la date d'inscription d'un utilisateur (au format JJ/MM/AAAA)|

### Les thèmes

Un thème appartient à un seul utilisateur. (1,1)

Un thème contient aucune ou plusieurs expressions. (0,n)

|||
|-|-|
|**id**|l'identifiant d'un thème|
|**title**|le titre d'un thème|
|**user_id**|l'identifiant d'un utilisateur|

### Les expressions

Une expression appartient à un seul utilisateur. (1,1)

Une expression est classée dans un seul thème. (1,1)

|||
|-|-|
|**id**|l'identifiant d'une expression|
|**french**|l'expression en français|
|**english**|la traduction en anglais|
|**phonetics**|la transcription phonétique|
|**user_id**|l'identifiant d'un utilisateur|
|**theme_id**|l'identifiant d'un thème|
