<?php

namespace App\Dal;

use App\Database\Connection;
use App\Models\User as UserModel;
use PDO;

class UserDal
{
    private $pdo; //usar para pegar o id

    public function __construct()
    {
        $this->pdo = Connection::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }


    public function Select()
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM user;";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Connection::disconnect();

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
    }

    public function SelectById(string $id)
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM user WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $user = new UserModel();
        $user->setId($data['id']);
        $user->setName($data['name']);
        $user->setPassword($data['password']);
        $user->setType($data['type']);

        return $user;
    }

    public function SelectByName(string $name)
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM user WHERE name = :name;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':name', $name);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        Connection::disconnect();

        return $data;
    }

    public function Update(UserModel $user)
    {
        $sql = "UPDATE user SET name = ?, password = ?, type = ? WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);

        $result = $query->execute(array($user->getName(), $user->getPassword(), $user->getType(), $user->getId()));
        Connection::disconnect();

        return $result;
    }

    public function insert(UserModel $user)
    {
        $pdo = Connection::connect();
        $sql = "INSERT INTO user (name, password, type) VALUES (:name, :password, :type)";
        $stmt = $pdo->prepare($sql);

        $name = $user->getName();
        $password = $user->getPassword();

        $type = $user->getType();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        $stmt->bindParam(':type', $type);

        $stmt->execute();
        $lastUserId = $pdo->lastInsertId();

        $user->setId($lastUserId);

        Connection::disconnect();

        return $user;
    }

    public function Delete(int $id)
    {
        $sql = "DELETE FROM user WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($id));
        Connection::disconnect();

        return $result;
    }
}
