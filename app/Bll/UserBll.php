<?php

namespace App\Bll;

use App\Dal\UserDal;
use App\Models\User as UserModel;

class UserBll
{
    public function Insert(UserModel $user)
    {
        $dalUser = new UserDal();

        return $dalUser->Insert($user);
    }

    public function getAllUsers()
    {
        $dalUser = new UserDal();

        return $dalUser->Select();
    }

    public function getUserById($id)
    {
        $dalUser = new UserDal();

        return $dalUser->SelectById($id);
    }

    public function SelectByName(string $name)
    {
        $dalUser = new UserDal();

        return $dalUser->SelectByName($name);
    }

    public function updateUser($id, $userData)
    {
        $user = new UserModel();
        $dalUser = new UserDal();

        $user->setId($id);
        $this->validateUserInput($userData, $user);

        $result = $dalUser->update($user);

        if (!$user) {
            return false;
        }

        return $result;
    }

    public function deleteUser($id)
    {
        $dalUser = new UserDal();
        return $dalUser->delete($id);
    }

    private function validateUserInput($data, UserModel $user)
    {

        if (!empty($data['name'])) {
            $user->setName($data['name']);
        }

        if (!empty($data['password'])) {
            $user->setPassword(md5($data['password']));
        }

        if (!empty($data['type'])) {
            $user->setType($data['type']);
        }
    }
}
