<?php

namespace App\Dal;

use App\Database\QueryBuilder;
use App\Models\User;

class UserDal
{
    function select()
    {

        $query = new QueryBuilder();

        $results = $query->select()->from("usuario")->get();

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
}
