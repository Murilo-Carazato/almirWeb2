<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\OrderController;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $orderController = new OrderController();
    $order = $orderController->show($id);
} else {
    die("ID inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Compiled and minified CSS -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">

    <!-- Compiled and minified JavaScript -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>

    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

    <title>Editar Orders</title>
</head>

<body>
    <div class="container indigo lighten-4 deep-orange-text col s12">
        <div class="center green">
            <h1>updatear Order</h1>
        </div>
        <div class="row  black-text">
            <form action="/public/index.php?action=updateOrder&id=<?php echo $order->getId(); ?>" method="POST" class="col s12">

                <div class="input-field col s8">
                    <input placeholder="informe a data" id="date" name="date" type="date" class="validate" value="<?php echo $order->getDate(); ?>">
                    <label for="date">Data</label>
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