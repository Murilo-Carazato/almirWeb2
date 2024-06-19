<?php

namespace App\Database;

use PDO;
use PDOException;

class Connection
{
    private static ?Connection $instance = null;
    private ?PDO $connection = null;
    private $host = 'localhost:3306';
    private $dbname = 'almirweb';
    private $username = 'root';
    private $password = 'root';

    // Constructor privado para impedir a criação direta de instâncias
    private function __construct()
    {
        // Não abre a conexão diretamente no construtor
    }

    // Método para obter a instância única (singleton)
    public static function getInstance(): Connection
    {
        if (self::$instance === null) {
            self::$instance = new Connection();
        }
        return self::$instance;
    }

    // Método para abrir a conexão com o banco de dados
    public function connect(): PDO
    {
        if ($this->connection === null) {
            try {
                $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=utf8";
                $this->connection = new PDO($dsn, $this->username, $this->password);
                $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            } catch (PDOException $e) {
                die($e->getMessage());
            }
        }
        return $this->connection;
    }

    // Método para fechar a conexão com o banco de dados
    public function disconnect(): void
    {
        $this->connection = null;
    }

    // Método para obter a conexão atual
    public function getConnection(): ?PDO
    {
        return $this->connection;
    }
}