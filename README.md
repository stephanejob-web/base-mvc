# Mini-MVC

Un framework MVC minimaliste en PHP pour comprendre le fonctionnement de l'architecture Model-View-Controller.

## Comment fonctionne l'architecture MVC ?

### Le flux d'une requête

```
Utilisateur demande une URL (ex: http://mvc-mini.test/)
                    ↓
    1. Point d'entrée : public/index.php
                    ↓
    2. Router : Trouve la route correspondante
                    ↓
    3. Controller : Exécute la logique métier
                    ↓
    4. Model : Récupère les données (BDD)
                    ↓
    5. View : Génère le HTML
                    ↓
    Utilisateur reçoit la page HTML
```

---

## Structure détaillée

```
mvc-mini/
├── public/
│   ├── index.php       # 🚪 POINT D'ENTRÉE - Toutes les requêtes passent ici
│   └── .htaccess       # Redirige toutes les URLs vers index.php
│
├── core/
│   ├── Router.php          # 🗺️  ROUTEUR - Mappe URL → Controller
│   ├── BaseController.php  # 🎨 Gère le rendu des vues
│   └── Database.php        # 💾 Connexion à la base de données
│
└── app/
    ├── Controllers/    # 🎮 LOGIQUE MÉTIER
    ├── Models/        # 📊 ACCÈS AUX DONNÉES
    └── Views/         # 🖼️  AFFICHAGE HTML
```

---

## Explication étape par étape

### 1️⃣ Le Point d'entrée (`public/index.php`)

**Rôle** : Bootstrap de l'application - Démarre tout

```php
// Charge l'autoloader Composer
require_once __DIR__ . '/../vendor/autoload.php';

// Importe les classes nécessaires
use Core\Router;
use App\Controllers\HomeController;

// Crée le routeur
$router = new Router();

// Définit les routes : URL → Controller@méthode
$router->get('/', HomeController::class . '@index');
$router->get('/articles', ArticleController::class . '@index');

// Analyse l'URL et appelle le bon controller
$router->dispatch($_SERVER['REQUEST_URI'], $_SERVER['REQUEST_METHOD']);
```

**Ce qui se passe** :
- ✅ Toutes les requêtes arrivent ici (grâce au `.htaccess`)
- ✅ Le routeur analyse l'URL demandée
- ✅ Il appelle le contrôleur correspondant

---

### 2️⃣ Le Routeur (`core/Router.php`)

**Rôle** : Faire correspondre une URL à un contrôleur

```php
class Router
{
    private array $routes = ['GET' => [], 'POST' => []];

    // Enregistre une route GET
    public function get(string $path, string $action): void
    {
        $this->routes['GET'][$path] = $action;
    }

    // Trouve et exécute le bon contrôleur
    public function dispatch(string $uri, string $method): void
    {
        $path = parse_url($uri, PHP_URL_PATH);

        foreach ($this->routes[$method] ?? [] as $route => $action) {
            if ($route === $path) {
                [$class, $method] = explode('@', $action);
                $controller = new $class();
                $controller->$method();
                return;
            }
        }

        // 404 si aucune route trouvée
        http_response_code(404);
        echo "404 - Page non trouvée";
    }
}
```

**Exemple concret** :
- URL demandée : `/articles`
- Route trouvée : `ArticleController@index`
- Action : Crée une instance de `ArticleController` et appelle `index()`

---

### 3️⃣ Le Controller (`app/Controllers/`)

**Rôle** : Chef d'orchestre - Coordonne Model et View

```php
namespace App\Controllers;

use Core\BaseController;
use App\Models\ArticleModel;

class ArticleController extends BaseController
{
    public function index(): void
    {
        // 1. Récupère les données via le Model
        $articleModel = new ArticleModel();
        $articles = $articleModel->all();

        // 2. Passe les données à la View
        $this->render('articles/index', [
            'title' => 'Liste des articles',
            'articles' => $articles
        ]);
    }
}
```

**Responsabilités** :
- ✅ Appelle le Model pour récupérer les données
- ✅ Traite/formate les données si besoin
- ✅ Envoie les données à la View
- ❌ **Pas de SQL** (c'est le rôle du Model)
- ❌ **Pas de HTML** (c'est le rôle de la View)

---

### 4️⃣ Le Model (`app/Models/`)

**Rôle** : Accès aux données - Communique avec la BDD

```php
namespace App\Models;

use Core\Database;

class ArticleModel
{
    // Récupère tous les articles
    public function all(): array
    {
        $stmt = Database::getPdo()->query(
            'SELECT id, title, body FROM articles ORDER BY id DESC'
        );
        return $stmt->fetchAll();
    }

    // Récupère un article par ID
    public function find(int $id): ?array
    {
        $stmt = Database::getPdo()->prepare(
            'SELECT id, title, body FROM articles WHERE id = :id'
        );
        $stmt->execute(['id' => $id]);
        return $stmt->fetch() ?: null;
    }
}
```

**Responsabilités** :
- ✅ Requêtes SQL
- ✅ Retourner des données brutes
- ❌ **Pas de logique d'affichage**
- ❌ **Pas de traitement métier complexe**

---

### 5️⃣ La View (`app/Views/`)

**Rôle** : Présentation - Génère le HTML

**Fichier : `app/Views/articles/index.php`**
```php
<h1><?= htmlspecialchars($title) ?></h1>

<ul>
    <?php foreach ($articles as $article): ?>
        <li>
            <h2><?= htmlspecialchars($article['title']) ?></h2>
            <p><?= htmlspecialchars($article['body']) ?></p>
        </li>
    <?php endforeach; ?>
</ul>
```

**Responsabilités** :
- ✅ Afficher les données reçues du Controller
- ✅ HTML, CSS, JavaScript
- ❌ **Pas de requêtes SQL**
- ❌ **Pas de logique métier**

---

### 6️⃣ Le Layout (`app/Views/layouts/base.php`)

**Rôle** : Template global - Structure HTML commune

```php
<!doctype html>
<html lang="fr">
<head>
    <title><?= $title ?? 'Mini MVC' ?></title>
</head>
<body>
    <nav>
        <a href="/">Accueil</a> |
        <a href="/articles">Articles</a>
    </nav>

    <main>
        <?= $content ?> <!-- Le contenu de chaque vue s'insère ici -->
    </main>
</body>
</html>
```

---

## Exemple complet : Afficher la liste des articles

### Utilisateur tape : `http://mvc-mini.test/articles`

**1. `.htaccess`** redirige vers `index.php`

**2. `index.php`** appelle le Router
```php
$router->dispatch('/articles', 'GET');
```

**3. `Router.php`** trouve la route
```php
// Route : /articles → ArticleController@index
$controller = new ArticleController();
$controller->index();
```

**4. `ArticleController.php`** récupère les données
```php
$articles = $articleModel->all(); // Appel au Model
$this->render('articles/index', ['articles' => $articles]);
```

**5. `ArticleModel.php`** interroge la BDD
```php
return Database::getPdo()->query('SELECT * FROM articles')->fetchAll();
```

**6. `BaseController.php`** génère le HTML
```php
// Charge la vue articles/index.php
// Insère le résultat dans layouts/base.php
// Renvoie le HTML final
```

**7. L'utilisateur** reçoit la page HTML complète

---

## Principe de séparation des responsabilités

| Composant | Question | Responsabilité |
|-----------|----------|----------------|
| **Router** | "Qui appeler ?" | Mappe URL → Controller |
| **Controller** | "Quoi faire ?" | Coordonne Model et View |
| **Model** | "Où sont les données ?" | Accès base de données |
| **View** | "Comment afficher ?" | Génération HTML |

---

## Auteur

**Stéphane Job**
- Email: stephane.job@laplateforme.io
- GitHub: [@jean-ely-gendrau](https://github.com/jean-ely-gendrau)
