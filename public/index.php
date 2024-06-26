<?php

require_once __DIR__ . '/../vendor/autoload.php';

use App\Controllers\AuthController;
use App\Controllers\OrderController;
use App\Controllers\UserController;
use App\Controllers\ProductController;
use App\Dal\OrderDal;

if (isset($_GET['action'])) {
    $action = $_GET['action'];
    $userController = new UserController();
    $authController = new AuthController();
    $productController = new ProductController();
    $orderController = new OrderController();

    if (isset($_GET['id'])) {
        $id = $_GET['id'];
    }

    switch ($action) {
            //User
        case 'registerUser':
            $userController->registerUser();
            break;
        case 'loginUser':
            $authController->loginUser();
            break;
        case 'logoutUser':
            $authController->logoutUser();
            break;

            //Product
        case 'createProduct':
            $productController->create();
            break;
        case 'updateProduct':
            $productController->update($id);
            break;
        case 'destroyProduct':
            $productController->destroy($id);
            break;

            //Order
        case 'createOrder':
            $orderController->create();
            break;
        case 'updateOrder':
            $orderController->update($id);
            break;
        case 'destroyOrder':
            $orderController->destroy($id);
            break;
    }
}

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}


if (isset($_SESSION['currentUser'])) {
    $user = unserialize($_SESSION['currentUser']);

    echo "<pre>";
    var_dump($user);
    echo "</pre>";
} else {
    echo "Usuário não está logado.";
}


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
        <li><a class="" href="/resources/views/login.php">login.php</a></li>
        <li><a class="" href="/public/index.php?action=logoutUser">logout.php</a></li>
        <li></li>
        <li><a class="" href="/resources/views/product/products.php">products.php</a></li>
        <li></li>
        <li><a class="" href="/resources/views/order/orders.php">orders.php</a></li>


    </ul>
</body>

</html>