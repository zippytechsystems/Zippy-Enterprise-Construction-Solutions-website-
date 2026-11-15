<?php
/**
 * Enterprise Database Connection Layer
 * PDO with dual driver: MySQL (Production/Hostinger) + SQLite (zero-config local fallback)
 */

require_once __DIR__ . '/config.php';

class Database {
    private static ?PDO $instance = null;
    private static string $driverUsed = 'mysql';

    public static function getConnection(): PDO {
        if (self::$instance !== null) {
            return self::$instance;
        }

        $mysqlHost = DB_HOST;
        $mysqlPort = DB_PORT;
        $mysqlDb   = DB_DATABASE;
        $mysqlUser = DB_USERNAME;
        $mysqlPass = DB_PASSWORD;

        // Try MySQL first
        try {
            $dsn = "mysql:host={$mysqlHost};port={$mysqlPort};dbname={$mysqlDb};charset=utf8mb4";
            $pdo = new PDO($dsn, $mysqlUser, $mysqlPass, [
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            ]);
            self::$instance = $pdo;
            self::$driverUsed = 'mysql';
            return self::$instance;
        } catch (PDOException $e) {
            // If MySQL is not reachable, fallback to SQLite for local development resilience
            $sqlitePath = __DIR__ . '/../database/zippy_construction.sqlite';
            $sqliteDir = dirname($sqlitePath);
            if (!is_dir($sqliteDir)) {
                mkdir($sqliteDir, 0755, true);
            }

            try {
                $dsn = "sqlite:{$sqlitePath}";
                $pdo = new PDO($dsn, null, null, [
                    PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                ]);
                // Enable foreign keys in SQLite
                $pdo->exec('PRAGMA foreign_keys = ON;');
                self::$instance = $pdo;
                self::$driverUsed = 'sqlite';

                // Check if tables are initialized; if not, initialize automatically
                self::ensureSchemaInitialized($pdo);

                return self::$instance;
            } catch (PDOException $sqliteEx) {
                die("Critical Database Connection Failure: " . htmlspecialchars($e->getMessage()));
            }
        }
    }

    public static function getDriver(): string {
        return self::$driverUsed;
    }

    private static function ensureSchemaInitialized(PDO $pdo): void {
        $check = $pdo->query("SELECT name FROM sqlite_master WHERE type='table' AND name='users'")->fetch();
        if (!$check) {
            require_once __DIR__ . '/../database/installer.php';
            DatabaseInstaller::installSqlite($pdo);
        }
    }
}
