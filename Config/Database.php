<?php

require '../vendor/autoload.php';
use Dotenv\Dotenv;

class Database {
    
    private $connection;
    
    public function __construct() {
        $dotenv = Dotenv::createImmutable(dirname(__DIR__,1));
        $dotenv->load();
        $this->connect($_ENV["DB_HOST"], $_ENV["DB_PORT"], $_ENV["DB_USER"], $_ENV["DB_PASS"], $_ENV["DB_NAME"]);
    }

    private function connect($host, $port, $user, $pass, $dbname) {
        $dsn = "mysql:host={$host};port={$port};dbname={$dbname};charset=utf8mb4";
        try {
            $this->connection = new PDO($dsn, $user, $pass);
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->connection;
        } catch (PDOException $e) {
            echo "Connection failed: " . $e->getMessage();
            exit;
        }
    }

    public function db() {
        return $this->connection;
    }
}