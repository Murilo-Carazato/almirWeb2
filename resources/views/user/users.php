<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UserController;
$userController = new UserController();
$users = $userController->index();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Usuários</title>
</head>

<body>
    <h1>Listar Usuários</h1>
    <table class="highlight">
        <tr>
            <th>ID</th>
            <th>Nome</th>
            <th>Senha</th>
            <th>Tipo</th>
        </tr>

        <?php foreach ($users as $user) { ?>
            <tr>
                <td><?php echo $user->getId(); ?></td>
                <td><?php echo $user->getName(); ?></td>
                <td><?php echo $user->getPassword(); ?></td>
                <td><?php echo $user->getType(); ?></td>

                <?php if ($user->getType() != "admin") { ?>
                    <td>
                        <a class="btn-floating btn-small waves-effect waves-light orange" onclick="JavaScript:location.href='/resources/views/user/userEditForm.php?id=' + '<?php echo $user->getId(); ?>'">
                            <i class="material-icons">edit</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light blue" onclick="JavaScript:location.href='/resources/views/user/userDetails.php?id=' + '<?php echo $user->getId(); ?>'"><i class="material-icons">details</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light red" onclick="JavaScript: remover( <?php echo $user->getId(); ?> )">
                            <i class="material-icons">delete</i></a>
                    </td>
                <?php } ?>

            </tr>
        <?php } ?>

    </table>

    <button class="waves-effect waves-light btn green" type="button" onclick="JavaScript:location.href='/resources/views/register.php'"><i class="material-icons">add</i>
    </button>
</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir o usuário ' + id + '?')) {
            location.href = '/public/index.php?action=destroyUser&id=' + id;
        }
    }
</script>