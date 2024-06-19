<?php

namespace App\Dal;

use App\Database\QueryBuilder;
use App\Models\User;

class UserDal
{

    private $table = "user";
    function select()
    {

        $query = new QueryBuilder();

        $results = $query->select()->from($this->table)->get();

        $users = [];

        foreach ($results as $result) {

            $user = new User();
            $user->setId($result['id']);
            $user->setName($result['name']);
            $user->setPassword($result['password']);

            $users[] = $user;
        }

        return $users;
    }

    function insert(User $user)
    {
        $query = new QueryBuilder();

        $data = [
            'name' => $user->getName(),
            'password' => $user->getPassword(),
        ];

        $result = $query->insert($data, $this->table);

        $user->setId($result);

        return $user;
    }

    function update(User $user)
    {
        $query = new QueryBuilder();

        $data = [
            'id' => $user->getId(),
            'name' => $user->getName(),
            'password' => $user->getPassword(),
        ];

        $query->update($data, $this->table);

        return $user;
    }

    function delete(int $id)
    {
        $query = new QueryBuilder();

        $query->delete($id, $this->table);

        return $query;
    }
}
