# Application Symfony ToDoList
## Install Symfony version 4.x.x
__Terminal__ : ``` composer create-project symfony/website-skeleton my_project_name "4.4.*"```
## Procédure d'installation
### Clone GitHub procédure
A faire
### Database
1. Config database dans fichier .env (ligne 32) :  
```DATABASE_URL=mysql://root:root@127.0.0.1:8889/db_todolist```  
2. Création physique de la base de données :  
```bin/console doctrine:database:create```  
### Entités
Les types de données de l'application :  
    On a 2 entités qui apparaissent : _Category_ et _Todo_.  
1. Category(id, name)  
2. Todo(id, title, content, createdAt, updatedAt, todoFor)  

Pour créer les deux entités : ```bin/console make:entity```  
Commencer par Category puis Todo.  
La relation se fera à partir de l'entité Todo, avec une propriété _category_id_ qui sera du type __relation__.

### Migration
1. Création du fichier de migration (code SQL) ```bin/console make:migration```
2. Executer la migration ```bin/console doctrine:migrations:migrate```  
--> créé les tables Todo et Category dans MySQL