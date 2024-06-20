<?php
namespace App\Bll;

use App\Dal\UserDal;
use App\Models\User as UserModel;

class UserBll
{
    public function Select()
    {
        $dalUser = new UserDal();

        return $dalUser->Select();
    }

    public function Insert(UserModel $user)
    {
        $dalUser = new UserDal();

        return $dalUser->Insert($user);
    }

}
?>