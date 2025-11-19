<?php
/**
 * Layout principal
 * -----------------
 * Ce fichier définit la structure HTML commune à toutes les pages.
 * Il inclut dynamiquement le contenu spécifique à chaque vue via la variable $content.
 */
?>
<!doctype html>
<html lang="fr">
<head>
  <meta charset="utf-8">

  <!-- Titre de la page (sécurisé avec htmlspecialchars, valeur par défaut si non défini) -->
  <title><?= isset($title) ? htmlspecialchars($title, ENT_QUOTES, 'UTF-8') : 'Mini MVC' ?></title>

  <!-- Bonne pratique : rendre le site responsive -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- (Optionnel) Ajout d’un peu de style basique -->
  <style>
    body { font-family: Arial, sans-serif; margin: 0; padding: 0; }
    nav { background: #f4f4f4; padding: 10px; }
    nav a { margin-right: 10px; text-decoration: none; color: #333; }
    main { padding: 20px; }
  </style>
</head>
<body>
  <!-- Menu de navigation global -->
  <nav>
        <a href="/">Accueil</a> |
        <a href="/articles">Articles</a>
        <a href ='/about'>A propos</a>
  </nav>

  <!-- Contenu principal injecté depuis BaseController -->
  <main>
    <?= $content ?>
  </main>
</body>
</html>
