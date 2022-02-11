## La conception

La base de données de l'application est définie selon le modèle suivant :

...

Elle se résume ainsi en X tables :

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
