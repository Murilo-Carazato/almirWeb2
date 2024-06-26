<?php

namespace App\Controllers;

class SessionController
{

    public function getCurrentUserId()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            return $user->getId();
        } else {
            echo "Usuário não está logado.";
            exit;
        }
    }
}
