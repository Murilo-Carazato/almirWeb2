<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\UserBll;
use App\Models\User as UserModel;

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

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $user = new UserModel();

        if (!empty($_POST['name'])) {
            $user->setName($_POST['name']);
        }
        if (!empty($_POST['password'])) {
            $user->setPassword(md5($_POST['password']));
        }

        $user->setType("client");

        $result = $this->userBll->insert($user);

        $_SESSION['currentUser'] = serialize($result);

        if ($result instanceof UserModel) {
            header("location: /resources/views/menu.php");
            exit();
        } else {
            echo "Erro ao criar usuário";
        }
    }

    public function index()
    {
        $users = $this->userBll->getAllUsers();
        return $users;
    }

    public function show($id)
    {
        return $this->userBll->getUserById($id);
    }

    public function update($id)
    {
        $userData = $_POST;

        $result = $this->userBll->updateUser($id, $userData);

        if ($result) {
            header("Location: /resources/views/user/users.php");
            exit();
        } else {
            echo "Erro ao atualizar usuário";
        }
    }

    public function destroy($id)
    {
        $result = $this->userBll->deleteUser($id);

        if ($result) {
            header("Location: /resources/views/user/users.php");
            exit();
        } else {
            echo "Erro ao deletar usuário";
        }
    }
}
