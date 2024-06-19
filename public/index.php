<?php

use App\Dal\UserDal;
use App\Models\User;

require_once __DIR__ . '/../vendor/autoload.php';

// use App\Database\QueryBuilder;

// $query = new QueryBuilder();

// var_dump($query->select()->from("usuario")->get());

$userDal = new UserDal();

//

// $users = $userDal->select();

// echo "<pre>";
// var_dump($users);
// echo "</pre>";

//

$userModel = new User();

// $userModel->setNome("Teste");
// $userModel->setSenha(md5("123"));
// $userInsert = $userDal->insert($userModel);


// echo "<pre>";
// var_dump($userInsert);
// echo "</pre>";

//

// $userModel->setId(1);
// $userModel->setNome("TesteUpdate2");
// $userModel->setSenha(md5("1234"));
// $teste = $userDal->update($userModel);


// echo "<pre>";
// var_dump($teste);
// echo "</pre>";

//

// $id = 4;

// $teste = $userDal->delete($id);

// echo "<pre>";
// var_dump($teste);
// echo "</pre>";


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

        <li><a class="" href="/App/VIEW/INVENTARIO/lstInventario.php">lstInventario.php</a></li>
        <li><a class="" href="/App/VIEW/INVENTARIO/formDetInventario.php?id=1">formDetInventario.php</a></li>
        <li><a class="" href="/App/VIEW/EQUIPAMENTO/formEdtInventario.php?id=1">formEdtInventario.php</a></li>
        <li><a class="" href="/App/VIEW/INVENTARIO/formInventario.php">formInventario.php</a></li>
        <li><a class="" href="/App/VIEW/RECEITA/lstReceita.php">lstReceita.php</a></li>
        <li><a class="" href="/App/VIEW/RECEITA/formReceita.php">formReceita.php</a></li>

    </ul>
</body>

</html>