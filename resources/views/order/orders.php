<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\OrderController;
use App\Controllers\SessionController;

$orderController = new OrderController();
$sessionController = new SessionController();

$data = $orderController->index();
$userId = $sessionController->getCurrentUserId();
$orders = $data;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Orders</title>
</head>

<body>
    <h1>Listar Orders</h1>
    <table class="highlight">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>IdUser</th>
        </tr>

        <?php foreach ($orders as $order) { ?>
            <tr>
                <td><?php echo $order->getId(); ?></td>
                <td><?php echo $order->getDate()->format('d-m-Y'); ?></td>
                <td><?php echo $order->getUserId(); ?></td>

                <?php if ($userId == $order->getUserId()) { ?>
                    <td>
                        <a class="btn-floating btn-small waves-effect waves-light orange" onclick="JavaScript:location.href='/resources/views/order/orderEditForm.php?id=' + '<?php echo $order->getId(); ?>'">
                            <i class="material-icons">edit</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light blue" onclick="JavaScript:location.href='/resources/views/order/orderDetails.php?id=' + '<?php echo $order->getId(); ?>'"><i class="material-icons">details</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light red" onclick="JavaScript: remover( <?php echo $order->getId(); ?> )">
                            <i class="material-icons">delete</i></a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>

    </table>

    <button class="waves-effect waves-light btn green" type="button" onclick="JavaScript:location.href='/resources/views/order/orderForm.php'"><i class="material-icons">add</i>
    </button>
</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir o produto ' + id + '?')) {
            location.href = '/public/index.php?action=destroyOrder&id=' + id;
        }
    }
</script>
