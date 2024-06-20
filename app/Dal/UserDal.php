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
        $sql = "SELECT * FROM user;";

        $con = Connection::connect();
        $data = $con->query($sql);
        $con = Connection::disconnect();

        $users = [];

        foreach ($data as $line) {

            $user = new UserModel();

            $user->setId($line['id']);
            $user->setName($line['name']);
            $user->setPassword($line['password']);

            $users[] = $user;
        }

        return $users;
    }

    public function insert(UserModel $user)
    {
        $pdo = Connection::connect();
        $sql = "INSERT INTO user (name, password) VALUES (:name, :password)";
        $stmt = $pdo->prepare($sql);

        $name = $user->getName();
        $password = $user->getPassword();

        $stmt->bindParam(':name', $name);
        $stmt->bindParam(':password', $password);

        $stmt->execute();
        $lastUserId = $pdo->lastInsertId();

        $user->setId($lastUserId);

        Connection::disconnect();

        return $user;
    }
}
