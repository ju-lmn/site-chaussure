# site-chaussure
## 1. Présentation du projet

L'objectif de ce projet est de **créer un site web permettant de répertorier différentes marques de chaussures** ainsi que **leurs modèles**.

Le site aura pour but de centraliser plusieurs informations :

- Les marques de chaussures.

- Les différents modèles.

- Les types de chaussures.

- Les prix et les couleurs.

- Les tailles disponibles.

- Les stocks associés à chaque taille.

Le projet sera réalisé en **plusieurs étapes**. La première consiste à **concevoir et créer** une base de données MySQL qui permettra de stocker et d'organiser toutes ces informations.

## 2. Organisation du projet

Le développement du site sera divisé en plusieurs étapes :
1. **Base de données :** création de la structure MySQL et insertion des premières données.
2. **Backend :** développement du fonctionnement du site et des échanges avec la base de données.
3. **Frontend :** création de l'interface utilisateur.
4. **Intégration :** connexion entre l'interface, le backend et la base de données.

## 3. Étape 1 : Création de la base de données

La première étape du projet consiste à créer une base de données nommée `gestion_chaussures`.

Elle permet de stocker les informations nécessaires au futur fonctionnement du site.

### Structure de la base de données

La base est composée de cinq tables :

| Table | Description |
|---|---|
| `marque` | Contient les marques de chaussures et leur pays d'origine. |
| `type` | Contient les différentes catégories de chaussures. |
| `chaussure` | Contient les modèles, leurs prix, leurs couleurs et leurs relations avec les marques et les types. |
| `taille` | Contient les différentes tailles disponibles. |
| `chaussure_taille` | Permet d'associer les chaussures aux tailles et de gérer les stocks. |
