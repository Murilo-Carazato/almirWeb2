<?php

namespace App\Database;

use Exception;
use PDO;
use PDOException;

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

    public function orderBy(string $column, string $order)
    {
        $this->query .= 'ORDER BY ' . $column . ' ' . $order . ' ';

        return $this;
    }

    function get()
    {
        $connection = Connection::connect();
        try {
            $stmt = $connection->prepare($this->query);
            $results = $stmt->execute();
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            Connection::disconnect();
            return $results;
        } catch (PDOException $e) {
            throw new Exception("erro de banco de dados: " . $e->getMessage());
        }
    }


    function insert(array $data, string $table)
    {
        $connection = Connection::connect();

        try {
            $stmt = $connection->prepare('INSERT INTO ' . $table . ' (' . implode(', ', array_keys($data)) . ') VALUES (' . implode(', ', array_fill(0, count($data), '?')) . ')');

            $paramNumber = 1;
            foreach ($data as $value) {
                $stmt->bindValue($paramNumber++, $value);
            }

            $stmt->execute();

            $lastInsertedId = $connection->lastInsertId();

            Connection::disconnect();

            return $lastInsertedId;
        } catch (PDOException $e) {
            throw new Exception("erro de banco de dados: " . $e->getMessage());
        }
    }

    public function update(array $data, string $table)
    {
        $connection = Connection::connect();

        try {
            // Construir a parte SET da query
            $setClause = [];
            foreach (array_keys($data) as $key) {
                if ($key !== 'id') {
                    $setClause[] = $key . ' = :' . $key;
                }
            }
            $setClause = implode(', ', $setClause);

     
            $sql = 'UPDATE ' . $table . ' SET ' . $setClause . ' WHERE id = :id';

        
            $stmt = $connection->prepare($sql);

   
            foreach ($data as $key => $value) {
                $stmt->bindValue(':' . $key, $value);
            }

           
            $update = $stmt->execute();

            Connection::disconnect();

            return $update;
        } catch (PDOException $e) {
            // Handle exception
            throw new Exception("Database Query Error: " . $e->getMessage());
        }
    }

    public function delete(int $id, string $table)
    {
        $connection = Connection::connect();

        try {
            $sql = 'DELETE FROM ' . $table . ' WHERE id = ?';
            $stmt = $connection->prepare($sql);
            $delete = $stmt->execute(array($id));

            Connection::disconnect();
            return $delete;

            
        } catch (PDOException $e) {
            // Handle exception
            throw new Exception("Database Query Error: " . $e->getMessage());
        }
    }
}
