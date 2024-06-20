<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\UserBll;
use App\Models\User;

class UserController
{
    private $userBll;

    public function __construct()
    {
        $this->userBll = new UserBll();
    }

    //register
    public function registerUser()
    {
        session_start();

        $user = new User();

        if (isset($_POST['name']) && !is_null($_POST['name'])) {
            $user->setName($_POST['name']);
        } 
        if (isset($_POST['password']) && !is_null($_POST['password'])) {
            $user->setPassword(md5($_POST['password']));
        }

        $result = $this->userBll->insert($user);

        $_SESSION['currentUser'] = serialize($result);

        if ($result instanceof User) {
            header("location: /resources/views/menu.php");
        } else {
            echo "Erro ao criar usuário";
        }
    }


}
