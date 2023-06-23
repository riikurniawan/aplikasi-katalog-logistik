<?php

class Database
{

    private $connection;

    public function __construct()
    {
        $this->connect(DB_HOST, DB_PORT, DB_USER, DB_PASS, DB_NAME);
    }

    private function connect($host, $port, $user, $pass, $dbname)
    {
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

    public function db()
    {
        return $this->connection;
    }
}
