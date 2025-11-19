# Bienvenue dans ton premier projet MVC en PHP 🎉

Ce dépôt est ton point de départ pour découvrir le modèle **MVC (Modèle – Vue – Contrôleur)**.  
Ton objectif : comprendre la séparation entre **modèle (données)**, **vue (HTML)** et **contrôleur (logique)**, puis compléter le projet avec de nouvelles fonctionnalités.

---

## 🚀 Installation

1. **Clone le dépôt depuis GitHub Classroom**  

    ```bash
    git clone 
    cd mvc-mini
    ```

2. **Crée la base de données** avec le script `script.sql` déjà présent.  

3. **Configure la connexion** dans `core/Database.php` si besoin.  

---

## 📂 Ce que tu trouves dans ce repo

- `/app/Controllers` → les contrôleurs  
- `/app/Models` → les modèles  
- `/app/Views` → les vues  
- `/core` → classes de base (Router, Database, BaseController)  
- `/public` → le point d’entrée (`index.php`)  

---

## 🏗 À faire (exercices)

- [ ] Ajouter une page `/about` avec un nouveau contrôleur et une vue.  
- [ ] Compléter le contrôleur Article avec une action `show($id)` qui affiche un article en détail.  
- [ ] Créer un formulaire pour ajouter un article (**Create**).  
- [ ] Implémenter la suppression d’un article (**Delete**).  
- [ ] Bonus : créer un layout plus joli (HTML + CSS).  

---

## ✅ Critères d’évaluation

- [ ] Le projet fonctionne (pages accessibles).  
- [ ] Respect du pattern MVC (pas de SQL dans les vues, pas de HTML dans les modèles).  
- [ ] Code clair et lisible (nommage, indentation).  
- [ ] Tu as complété au moins 2 fonctionnalités supplémentaires.  
- [ ] README mis à jour si nécessaire.  

---

## 📦 App ou Src ?

Dans ce projet, tu trouves un dossier **`app/`** qui contient tes contrôleurs, modèles et vues. C’est un choix volontaire car il est plus clair et plus accessible pour un premier projet.

👉 En milieu **professionnel**, on utilise souvent **`src/`** (source code), surtout avec Composer et l’autoload PSR-4. L’idée est de séparer ton code métier (`src/`) du reste du projet (`tests/`, `config/`, etc.).

- **Formation / apprentissage** → garde `app/` (plus pédagogique et lisible).  
- **Projets pros / avec Composer** → utilise `src/` pour respecter les standards.

Ainsi, tu verras que **les deux approches existent** : `app/` pour apprendre, `src/` dans les environnements pros.

---

👉 Phrase clé à retenir : *Le modèle manipule les données, le contrôleur décide, la vue affiche.*

---

## 🧰 Installation rapide avec Laragon (Windows)

> Laragon facilite le développement local avec Apache, MySQL/MariaDB et PHP.

1. **Place le projet**  
   Copie le dossier `mvc-mini` dans `C:\laragon\www`.

2. **Démarre Laragon**  
   Ouvre Laragon et clique sur **Start All** (Apache + MySQL démarrés).

3. **Crée la base de données**  
   - Menu **Laragon → Database → HeidiSQL** (ou phpMyAdmin).  
   - Crée une base nommée `mvc` et exécute le script du fichier `mini-mvc.sql` (ou celui du README ci‑dessus).

4. **Identifiants par défaut**  
   - **MySQL user** : `root`  
   - **MySQL pass** : *(vide)*  
   - Vérifie/édite ces valeurs dans `core/Database.php`.

5. **Accède à l’application**  
   - Le plus simple : **<http://localhost/mvc-mini/public/>**  
   - (Option) Activer les *auto virtual hosts* de Laragon → URL : **<http://mvc-mini.test/public/>**

6. **Réécriture d’URL (Apache)**  
   Dans le dossier `public/`, ajoute un fichier **.htaccess** :
        ```apache
        # public/.htaccess — réécrit toutes les requêtes vers index.php
        RewriteEngine On
        RewriteCond %{REQUEST_FILENAME} !-f
        RewriteCond %{REQUEST_FILENAME} !-d
        RewriteRule . index.php [L]
        ```

   > Avec ce .htaccess, tu peux définir des routes propres côté Router sans créer des fichiers physiques.

### (Optionnel) VHost pointant directement sur /public

Si tu veux **<http://mvc-mini.test>** sans le `/public`, crée un vhost Laragon personnalisé (Menu → Apache → sites-enabled) qui pointe `DocumentRoot` vers `C:/laragon/www/mvc-mini/public`. Exemple :

```apache
<VirtualHost *:80>
    ServerName mvc-mini.test
    DocumentRoot "C:/laragon/www/mvc-mini/public"
    <Directory "C:/laragon/www/mvc-mini/public">
        AllowOverride All
        Require all granted
    </Directory>
</VirtualHost>
```
> Redémarre Apache après modification.

### Vérifications rapides

- ✅ `http://localhost/mvc-mini/public/` affiche la page d’accueil.
- ✅ `http://localhost/mvc-mini/public/articles` liste les articles (table vide au début, c’est normal).
- ✅ Aucune erreur PHP dans Laragon (regarde le bouton **Logs** si besoin).
