<?php

namespace Core\Database;

use Core\Constants\Constants;
use PDO;

class Database
{
    private static function connect(string $dbName): PDO
    {
        $user = $_ENV['DB_USERNAME'];
        $pwd  = $_ENV['DB_PASSWORD'];
        $host = $_ENV['DB_HOST'];
        $port = $_ENV['DB_PORT'];

        $pdo = new PDO("pgsql:host=$host;port=$port;dbname=$dbName", $user, $pwd);
        $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        return $pdo;
    }

    public static function getDatabaseConn(): PDO
    {
        return self::connect($_ENV['DB_DATABASE']);
    }

    public static function create(): void
    {
        $db = $_ENV['DB_DATABASE'];
        $conn = self::connect('postgres');
        $conn->exec("DROP DATABASE IF EXISTS $db;");
        $conn->exec("CREATE DATABASE $db;");
    }

    public static function drop(): void
    {
        $db = $_ENV['DB_DATABASE'];
        $conn = self::connect('postgres');
        $conn->exec("DROP DATABASE IF EXISTS $db;");
    }

    public static function migrate(): void
    {
        $sql = file_get_contents(Constants::databasePath()->join('schema.sql'));
        self::getDatabaseConn()->exec($sql);
    }

    public static function exec(string $sql): void
    {
        self::getDatabaseConn()->exec($sql);
    }
}
