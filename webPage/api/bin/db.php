<?php
require __DIR__ . '/../vendor/autoload.php';

use Dotenv\Dotenv;

class DB
{
    private String $host;
    private String $user;
    private String $password;
    private String $database;

    public function __construct()
    {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();

        $this->host = $_ENV['HOST_DB'];
        $this->user = $_ENV['USER_DB'];
        $this->password = $_ENV['PASSWORD_DB'];
        $this->database = $_ENV['DATABASE_DB'];
    }

    public function connect(): ?PDO
    {
        $host = $this->host;
        $user = $this->user;
        $password = $this->password;
        $db = $this->database;

        try {
            $conn = new PDO("mysql:host=$host;dbname=$db", $user, $password);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo 'Error: ' . $e->getMessage();
        }

        return null;
    }
}