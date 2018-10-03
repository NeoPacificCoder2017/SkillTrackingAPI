<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SkillsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /**
         * Module HTML et CSS
         *
         */
        DB::table('skills')->insert([
            'name' => 'Mettre en forme des textes dans une page Web',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Connaître la structure de page HTML',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Utiliser les Mediaqueries et faire des sites "Responsive"',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Insérer des images dans une page Web',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Ajouter des liens hypertextes',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Insérer des objets multimédia (audio, vidéo)',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Gérer des formulaires',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Connaître les bases du référencement',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Utiliser des feuilles de styles externes',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Savoir manipuler les modèles de boîtes et les styles de base',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Positionner des éléments avec CSS (normal, relatif, absolu, flottant)',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Mettre en place des ombrages, du dégradé ou de la transparence)',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Mettre en place des ombrages, du dégradé ou de la transparence',
            'module_id' => 1,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        /*
            fin du module HTML et CSS
        */
        
        /*
            Module Javascript
        */

        DB::table('skills')->insert([
            'name' => 'Manipuler le DOM',
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Utiliser JQuery et intégrer des bibliothèques (JQueryUI, datePicker ...)',
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Appeler des API en Ajax (API privées et API tierces)',
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => 'Tester un programme (principes des tests unitaires)',
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Contrôler les données d'un formulaire",
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Réagir aux événements (clics, claviers) de l'utilisateur",
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Manipuler des données en JSON",
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Afficher des données JSON",
            'module_id' => 2,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

       /*
            fin du module Javascript
        */
        
        /*
            Module Base de données
        */

        DB::table('skills')->insert([
            'name' => "Lire/Créer un diagramme UML de base de donnée",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer un shéma de base de données",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Connaitre les principaux type de données",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => " Connaître les commandes de bases SQL",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser PhpMyAdmin pour administrer ses bases",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Situer la base de données dans l'architecture du site Web",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Traduire les besoins client en régles de gestion métier",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer un Modéle de Conception de Données MCD",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Lire un MCD",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Faire des requêtes SQL avec jointures",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Choisir le bon type et la bonne taille des données à stocker",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Normaliser en 3ème forme normale (3NF)",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Comprendre l'intérêt de la normalisation",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Dé-normaliser un modèle en 3NF",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Comprendre l'intérêt de la dé-normalisation",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "S'approprier le vocabulaire inhérent à la conception de bases de données",
            'module_id' => 3,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        /*
         * Fin du module Base de donéées
        */

        /**
         * Module PHP & MVC
         */

        DB::table('skills')->insert([
            'name' => "Installer un framework PHP avec composer",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Configuer le fichier de routing",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Comprendre le patron d'architecture logicielle Modéle-Vue-Contrôleur MVC",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser un moteur de template",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Comprendre la notion d'objet et d'héritage",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Intégrer des données dynamiques sur les pages",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer un model avec l'ORM",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Manipuler (créer/modifier/supprimer) des données via un ORM",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer un formulaire et enregistrer les données en BDD",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Valider les données d'un formulaire",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        

        DB::table('skills')->insert([
            'name' => "Mettre en place des relations entre les modèles",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        

        DB::table('skills')->insert([
            'name' => "Valider les données d'un formulaire",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        

        DB::table('skills')->insert([
            'name' => "Sécuriser l'accès à son application entre les modèles",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Utiliser les Sessions pour maintenir l'utilisateur authentifié durant sa session", 
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer une API RESTfull au format JSON",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser les 'Migrations' pour créer ou modifier la base de données",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Savoir installer une librairie externe avec COMPOSER",
            'module_id' => 4,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        /**
         * Fin du modules PHP ET MVC
         */

         /**
          * Graphisme Web
          */

        DB::table('skills')->insert([
            'name' => "Savoir créer une Brush Photoshop",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Maquette Papier",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Compréhension de l'impact de la couleur",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Création d'un Logo",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Comprendre les calques",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Savoir créer un Gifs animé (loader Ajax)",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Connaître les différences caractéristiques d'une image",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Adapter l'image à la situation",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Appréhender la fonction de fichiers d'images",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Compréhension de la Typographie",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Paramétrer son logiciel",
            'module_id' => 5,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

       
        /**
         * Fin du modules Graphisme Web
         */

        /**
         * Modules Web Mobile
         */

        DB::table('skills')->insert([
            'name' => "Différencier le  du mobile natif",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Expliquer ce qu'est Cordova",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Installer un environnement de développement android",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser les 3 environnements de développements",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Manipuler des données dans un controller en AngularJS",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser un gestionnaire de tâche",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser le plugin cordova de géolocalisation",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Utiliser des APls externes (Accès à la base de données du réseau social, Google Maps, ...)",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Personnaliser son splash screen",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Personnaliser son logo",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Minifier son code Javascript et CSS",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Décrire les étapes pour développer sous google play",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer un service en AngularJS",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        DB::table('skills')->insert([
            'name' => "Créer une factory en ANgulars JS",
            'module_id' => 6,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        
        /**
         * Fin du modules Web Mobile
         */

        /**
         * Modules Réseau - Système
         */
        DB::table('skills')->insert([
            'name' => "Utiliser les commandes de base de linux",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Expliquer ce que c'est qu'un serveur WEB",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Se connecter à un serveur en SSH",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Installer l'environnement Web (PHP, Apache, Mysql)",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Copier des fichiers avec SCP ou SFTP",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Rédiger et présenter une documentation technique",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        
        DB::table('skills')->insert([
            'name' => "Débugger en lisant un fichier de log",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

        
        DB::table('skills')->insert([
            'name' => "Faire tourner deux versions du site sur un serveur",
            'module_id' => 7,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);

            
        /**
         * Fin du modules Réseau - Système
         */

        /**
         * Modules Java
         */
        DB::table('skills')->insert([
            'name' => "Utiliser la syntaxe de base du langage JaVA",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Manipuler des objets et des classes (constructeurs, setters, instanciation, méthodes)",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Mettre en oeuvre l'héritage objet",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Manipuler les collections d'objet",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Gérer les exceptions (erreurs)",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Modéliser au travers d'UML (diagrammes de classe, de Uses-cas, de séquence, ....)",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Accéder aux données avec JDBC",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Mettre en oeuvre les bonnes pratiques d'accès aux données conformément au pattern DAO",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Créer un service web en JAVA",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);
        DB::table('skills')->insert([
            'name' => "Déployer le service",
            'module_id' => 8,
            'created_at' => '2018-07-05 12:03:37',
            'updated_at' => '2018-07-05 12:03:37'
        ]);


        /**
         * Fin du modules Java
         */

    }
}
