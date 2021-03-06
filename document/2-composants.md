## Les composants

### Le layout

**Vue** : base.html.twig

Il s'agit du modèle de base pour l'ensemble des pages et du design.

### Le menu de navigation

**Vue** : partials/navbar.html.twig

Un menu de navigation du site est visible tout en haut de chaque page et contient :
- le titre **Sym-CRM** tout à gauche, avec un lien vers la page d'accueil
- les liens des différentes pages à droite dans cet ordre :
    - Déconnexion (si connecté)
    - le nom complet (prénom et nom, société) de l'utilisateur, avec un lien vers sa page de profil
    - Utilisateurs (si administrateur)
    - Equipes (si manager)
    - Contacts (liste des contacts, si connecté)
    - Evénements (liste des événements, si connecté)

### Le pied de page

**Vue** : partials/footer.html.twig

Un pied de page est visible tout en bas de chaque page avec la mention **Sym-CRM** &copy; 2022 et des liens vers les pages :
- des **Mentions Légales**
- de la **Politique de Confidentialité**

### Les messages d'alerte

**Vue** : partials/alerts.html.twig

Les messages d'alerte (ou flash) s'affichent pour valider une action ou notifier une erreur comme :
- la confirmation d'une (dé)connexion
- un champ non valide dans un formulaire
- l'ajout d'un nouveau contact