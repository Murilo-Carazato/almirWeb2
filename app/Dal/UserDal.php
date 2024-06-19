<?php

namespace App\Dal;

use App\Database\QueryBuilder;
use App\Models\User;

class UserDal
{

    private $table = "usuario";
    function select()
    {

        $query = new QueryBuilder();

        $results = $query->select()->from($this->table)->get();

        $users = [];

        foreach ($results as $result) {

            $user = new User();
            $user->setId($result['id']);
            $user->setNome($result['nome']);
            $user->setSenha($result['senha']);

            $users[] = $user;
        }

        return $users;
    }

    function insert(User $user)
    {
        $query = new QueryBuilder();

        $data = [
            'nome' => $user->getNome(),
            'senha' => $user->getSenha(),
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
            'nome' => $user->getNome(),
            'senha' => $user->getSenha(),
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
