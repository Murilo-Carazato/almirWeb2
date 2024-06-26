<?php

namespace App\Dal;

use App\Database\Connection;
use App\Models\User as UserModel;
use PDO;
use PDOException;

class UserDal
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    {
        Connection::disconnect();
    }

    public function Select()
    {
        try {
            $sql = "SELECT * FROM user;";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $users = [];
            foreach ($data as $line) {
                $user = new UserModel();
                $user->setId($line['id']);
                $user->setName($line['name']);
                $user->setPassword($line['password']);
                $user->setType($line['type']);
                $users[] = $user;
            }

            return $users;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function SelectById(string $id)
    {
        try {
            $sql = "SELECT * FROM user WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $user = new UserModel();
                $user->setId($data['id']);
                $user->setName($data['name']);
                $user->setPassword($data['password']);
                $user->setType($data['type']);
                return $user;
            } else {
                throw new \Exception("User not found");
            }
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function SelectByName(string $name)
    {
        try {
            $sql = "SELECT * FROM user WHERE name = :name;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':name', $name);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                return $data;
            } else {
                throw new \Exception("User not found");
            }
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Update(UserModel $user)
    {
        try {
            $sql = "UPDATE user SET name = ?, password = ?, type = ? WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([$user->getName(), $user->getPassword(), $user->getType(), $user->getId()]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function insert(UserModel $user)
    {
        try {
            $sql = "INSERT INTO user (name, password, type) VALUES (:name, :password, :type)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':name', $user->getName());
            $stmt->bindParam(':password', $user->getPassword());
            $stmt->bindParam(':type', $user->getType());

            $stmt->execute();
            $lastUserId = $this->pdo->lastInsertId();
            $user->setId($lastUserId);

            return $user;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Delete(int $id)
    {
        try {
            $sql = "DELETE FROM user WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([$id]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }
}
