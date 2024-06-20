<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\UserController;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $controller = new UserController();

    switch ($action) {
        case 'postUser':
            $controller->postUser();
            break;
    }
}

session_start();


if (isset($_SESSION['currentUser'])) {
    $user = unserialize($_SESSION['currentUser']);
} else {
    echo "Usuário não está logado.";
}

echo "<pre>";
var_dump($user);
echo "</pre>";


//$_SERVER[] //se redirecionar para userController, switch de rota simples, retorna pro controller


?>
<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu de Navegação</title>
    <style>

    </style>
</head>

<body>
    <h1>Menu de Navegação</h1>
    <ul>

        <li>TESTE CARAZATO</li>
        <li><a class="" href="/resources/views/register.php">register.php</a></li>


    </ul>
</body>

</html>