<?php
// src/Utils/Database.php
require_once __DIR__ . '/../../vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../../');
$dotenv->load();

class Database {
    private static $instance = null;

    private function __construct() {
        // Private constructor to prevent multiple instances
    }

    public static function getInstance() {
        if (self::$instance == null) {
            $host = getenv('DB_HOST') ?: $_ENV['DB_HOST'];
            $dbname = getenv('DB_NAME') ?: $_ENV['DB_NAME'];
            $username = getenv('DB_USER') ?: $_ENV['DB_USER'];
            $password = getenv('DB_PASS') ?: $_ENV['DB_PASS'];

            self::$instance = new PDO("mysql:host=$host;dbname=$dbname", $username, $password, [
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
            ]);
        }
        return self::$instance;
    }
}