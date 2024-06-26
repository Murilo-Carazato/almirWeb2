<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Bll\ProductBll;
use App\Controllers\UserController;

if (isset($_GET['id'])) {
    $id = $_GET['id'];


    $userController = new UserController();
    $user = $userController->show($id);

    var_dump($user);
    echo $user->getPassword();
} else {
    die("ID inválido.");
}
?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <title>Inserir Pedido</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/init.js"></script>
</head>

<body>
    <?php //include_once '../menu.php'; 
    ?>
    <div class="container indigo lighten-4 deep-orange-text col s12">
        <div class="center green">
            <h1>Inserir Receita</h1>
        </div>
        <div class="row black-text">
            <form action="/public/index.php?action=updateUser&id=<?php echo $user->getId(); ?>" method="POST" class="col s12">

                <div class="input-field col s8">
                    <input placeholder="informe o email" id="email" name="name" type="text" class="validate" value="<?php echo $user->getName(); ?>">
                    <label for="email">Email</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="informe a senha" id="password" name="password" type="text" class="validate" value="<?php echo $user->getPassword(); ?>">
                    <label for="password">Senha</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="informe o tipo" id="type" name="type" type="text" class="validate" value="<?php echo $user->getType(); ?>">
                    <label for="type">Tipo</label>
                </div>

                <div class="brown lighten-3 center col s12">
                    <br>
                    <button class="waves-effect waves-light btn green" type="submit">
                        Gravar <i class="material-icons">save</i>
                    </button>
                    <br>
                    <br>
                </div>
            </form>
        </div>
    </div>
</body>

</html>