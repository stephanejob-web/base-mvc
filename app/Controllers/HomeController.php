<?php
namespace App\Controllers;

use Core\BaseController;

/**
 * Classe HomeController
 * ----------------------
 * Contrôleur responsable de la gestion de la page d'accueil.
 * Hérite de BaseController afin de bénéficier des méthodes utilitaires
 * comme render() pour afficher les vues.
 */
class HomeController extends BaseController
{
    /**
     * Action principale (point d'entrée de la page d'accueil)
     *
     * @return void
     */
    public function index(): void
    {
        // Appelle la méthode render() de BaseController
        // - Charge la vue "app/Views/home/index.php"
        // - Injecte le tableau de paramètres (ici, une variable $title utilisable dans la vue)
        // - Insère le contenu de la vue dans le layout global "base.php"
        $this->render('home/index', [
            'title' => 'Bienvenue sur le mini-MVC'
        ]);
    }

    public function about(): void{
        $this->render('home/about', [
           'title' =>  "A propos"
        ]);
    }
}
