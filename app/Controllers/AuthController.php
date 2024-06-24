<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\UserBll;
use App\Models\User;

class AuthController
{
    private $userBll;

    public function __construct()
    {
        $this->userBll = new UserBll();
    }

    public function loginUser()
    {

        if (isset($_POST['name']) && !is_null($_POST['name'])) {
            $name = $_POST['name'];
        }
        if (isset($_POST['password']) && !is_null($_POST['password'])) {
            $password = $_POST['password'];
        }

        $result = $this->userBll->SelectByName($name);

        if (md5($password) == $result['password']) {

            if (session_status() == PHP_SESSION_NONE) {
                session_start();
            }

            $user = new User();

            $user->setId($result['id']);
            $user->setName($result['name']);
            $user->setPassword($result['password']);
            $user->setType($result['type']);

            $_SESSION['currentUser'] =  serialize($user);
            header("location: /resources/views/menu.php");
        } else header("location:index.html");
    }

    public function logoutUser()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        session_destroy();
        header("Location: /resources/views/login.php");
    }
}
