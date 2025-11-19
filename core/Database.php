<?php
namespace Core;

use PDO;
use PDOException;

/**
 * Classe Database
 * ----------------
 * Classe utilitaire qui centralise la connexion à la base de données via PDO.
 * Elle utilise le pattern Singleton afin de garantir une seule instance de connexion
 * partagée dans toute l'application.
 */
class Database
{
    /**
     * Instance PDO unique (Singleton)
     * @var PDO|null
     */
    private static ?PDO $pdo = null;

    /**
     * Méthode d'accès à l'instance PDO
     *
     * @return PDO
     */
    public static function getPdo(): PDO
    {
        // Si aucune connexion n'existe encore, on l'initialise
        if (!self::$pdo) {
            // Paramètres de connexion
            $dsn = 'mysql:host=localhost;dbname=mvc;charset=utf8mb4';
            $user = 'root';
            $pass = '780662aB2';

            try {
                // Création de l'instance PDO avec options
                self::$pdo = new PDO($dsn, $user, $pass, [
                    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, // Active les exceptions en cas d'erreur SQL
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC, // Retourne les résultats sous forme de tableau associatif
                ]);
            } catch (PDOException $e) {
                // En cas d'échec de connexion, on stoppe le script avec un message générique
                // ⚠️ En production, il est préférable de loguer l'erreur au lieu d'afficher un message direct
                exit('Erreur de connexion BDD');
            }
        }

        // Retourne toujours la même instance PDO
        return self::$pdo;
    }
}
