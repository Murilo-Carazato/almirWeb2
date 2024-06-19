<?php

namespace App\Database;

use Exception;
use PDO;

class QueryBuilder
{

    private string $query;

    function select(string $columns = "*")
    {
        $this->query = "SELECT $columns ";
        return $this;
    }

    function from(string $table)
    {
        $this->query .= "FROM $table ";
        return $this;
    }

    function where(string $column, string $operator, $value)
    {
        $this->query .= "WHERE $column $operator $value ";
        return $this;
    }

    // andWhere

    function get()
    {
        $connectionInstance = Connection::getInstance();
        $connect = $connectionInstance->connect();
        try {
            $stmt = $connect->prepare($this->query);
            $results = $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $connectionInstance->disconnect();
            return $results;
        } catch (\PDOException $e) {
            throw new \Exception("erro de banco de dados: ".$e->getMessage());
        }
    }
}
