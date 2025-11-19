<?php
// Chargement manuel des fichiers nécessaires au fonctionnement de l'application
//require __DIR__ . '/../core/Router.php';           // Classe responsable de la gestion des routes
//require __DIR__ . '/../core/BaseController.php';  // Classe de base pour tous les contrôleurs
//require __DIR__ . '/../core/Database.php';        // Gestion de la connexion et des requêtes à la base de données
//require __DIR__ . '/../app/Controllers/HomeController.php';   // Contrôleur de la page d'accueil
//require __DIR__ . '/../app/Models/ArticleModel.php';          // Modèle pour la gestion des articles
require_once __dir__ . '/../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__."/..");
$dotenv->safeLoad();
// Importation des classes avec namespaces pour éviter les conflits de noms
use Core\Router;
use App\Controllers\HomeController;
use App\Controllers\ArticleController;

// Initialisation du routeur
$router = new Router();

// Définition des routes de l'application
// La route "/" pointe vers la méthode "index" du contrôleur HomeController
$router->get('/', 'App\\Controllers\\HomeController@index');
$router->get ('/about', 'App\\Controllers\\HomeController@about');
// La route "/articles" pointe vers la méthode "index" du contrôleur ArticleController
$router->get('/articles', 'App\\Controllers\\ArticleController@index');

// Exécution du routeur :
// On analyse l'URI et la méthode HTTP pour appeler le contrôleur et la méthode correspondants
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
