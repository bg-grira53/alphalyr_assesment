# Utilisateur Technique
1- Installer Symfony version 5.5.3 `https://symfony.com/doc/current/setup.html`

2- Cloner le projet à partir du dépôt Git

3- Installer les dépendances en exécutant la commande `composer install`

4- Configurer les paramètres de la base de données dans le fichier `.env` à la racine du projet

5- Créer la base de données en exécutant la commande `php bin/console doctrine:database:create`

6- Mettre à jour la base de données en exécutant la commande `php bin/console doctrine:schema:update --force`

7- Démarrer le serveur web en exécutant la commande `php bin/console server:start` ou `symfony server:start`

8- Accéder à l'application via un navigateur web en tapant `http://localhost:8000`


# Utilisateur Non Technique

1 -Accéder à l'API :
    Assurez-vous que vous avez accès à l'URL de l'API.

2- Tester l'API "récupère la liste des utilisateurs" :
    Ouvrez votre navigateur web et accédez à l'URL suivante : "http://<url_de_l_api>/users/"
    Si l'API fonctionne correctement, vous devriez voir une liste d'utilisateurs s'afficher.

3- Tester l'API "créé un utilisateur" :
    Ouvrez un outil comme Postman et envoyez une requête POST à l'URL suivante : "http://<url_de_l_api>/users/"
    Dans le corps de la requête, ajoutez les informations de l'utilisateur que vous souhaitez créer (par exemple, "name", "email", "group_id", etc.).
    Si l'API fonctionne correctement, vous devriez recevoir une réponse indiquant que l'utilisateur a été créé.

4- Tester l'API "récupère les informations d’un utilisateur" :
    Ouvrez votre navigateur web et accédez à l'URL suivante : "http://<url_de_l_api>/users/{id}/" (remplacez "{id}" par l'identifiant de l'utilisateur que vous souhaitez récupérer).
    Si l'API fonctionne correctement, vous devriez voir les informations de l'utilisateur s'afficher.

5- Tester l'API "modifie les informations d’un utilisateur" :
    Ouvrez un outil comme Postman et envoyez une requête PUT à l'URL suivante : "http://<url_de_l_api>/users/{id}/" (remplacez "{id}" par l'identifiant de l'utilisateur que vous souhaitez modifier).
    Dans le corps de la requête, ajoutez les informations de l'utilisateur que vous souhaitez modifier (par exemple, "name", "email", "group_id", etc.).
    Si l'API fonctionne correctement, vous devriez recevoir une réponse indiquant que les informations de l'utilisateur ont été modifiées.

6- Tester l'API "récupère la liste des groupes" :
    Ouvrez votre navigateur web et accédez à l'URL suivante : "http://<url_de_l_api>/groups/"
    Si l'API fonctionne correctement, vous devriez voir une liste de groupes s'afficher.

7- Tester l'API "créé un groupe" :
    Ouvrez un outil comme Postman et envoyez une requête POST à l'URL suivante : "http://<url_de_l_api>/groups/"
    Dans le corps de la requête, ajoutez les informations du groupe que vous souhaitez créer (par exemple, "name", "description", etc.).
    Si l'API fonctionne correctement, vous devriez recevoir une réponse indiquant que le groupe a été créé.
    
8- Tester l'API "récupère les informations d’un groupe" :
    Ouvrez votre navigateur web et accédez à l'URL suivante : "http://<url_de_l_api>/groups/{id}/" (remplacez "{id}" par l'identifiant du groupe que vous souhaitez récupérer).