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

## 4. Installation et configuration de l'environnement

Pour faire fonctionner le projet, il est nécessaire de configurer les informations de connexion à la base de données.

### Fichier `.env`

Le fichier `.env` permet de stocker les informations de configuration du projet, notamment les identifiants de connexion à la base de données :

- Le nom de la base de données.
- Le nom d'utilisateur MySQL.
- Le mot de passe.
- L'adresse du serveur de base de données.

L'utilisation de ce fichier permet de ne pas écrire directement les identifiants dans le code PHP. Cela facilite également la modification de la configuration sans avoir à modifier plusieurs fichiers du projet.

**Attention :** le fichier `.env` contient des informations sensibles. Il ne doit donc pas être publié sur GitHub. Il faut l'ajouter au fichier `.gitignore`.

### Utilisation de la bibliothèque `vlucas/phpdotenv`

La bibliothèque `vlucas/phpdotenv` permet de lire automatiquement les informations présentes dans le fichier `.env`.

Elle rend ces informations accessibles au code PHP grâce à des variables d'environnement.

Pour l'installer, il faut utiliser Composer avec la commande suivante :

```bash
composer require vlucas/phpdotenv
