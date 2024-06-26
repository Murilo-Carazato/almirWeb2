<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\OrderController;
use App\Controllers\SessionController;
use App\Dal\OrderDal;

$orderController = new OrderController();
$sessionController = new SessionController();

$orders = $orderController->index();
$userId = $sessionController->getCurrentUserId();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Pedidos</title>
</head>

<body>
    <h4>Listar Pedidos</h4>
    <table class="highlight">
        <tr>
            <th>ID</th>
            <th>Data</th>
            <th>Quantidade</th>
            <th>Preço total</th>
            <th>IdUser</th>
            <th>IdProduct</th>
        </tr>

        <?php foreach ($orders as $order) { ?>
            <tr>
                <td><?php echo $order->getId(); ?></td>
                <td><?php echo $order->getDate()->format('d-m-Y H:i:s'); ?></td>
                <td><?php echo $order->getQuantity(); ?></td>
                <td><?php echo $order->getTotalPrice(); ?></td>
                <td><?php echo $order->getUserId(); ?></td>
                <td><?php echo $order->getProductId(); ?></td>

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

    <hr>

    <h4>Listar Detalhe dos Pedidos</h4>
    <table>
        <tr>
            <th>User ID</th>
            <th>Name</th>
            <th>Produto</th>
            <th>Preço total do pedido</th>
            <th>Custo do usuário no modo admin</th>
            <th>Custo do usuário no modo client</th>
        </tr>

        <?php
        $dal = new OrderDal;
        $orderDetails = $dal->ShowOrderDetails();

        foreach ($orderDetails as $orderDetail) {
        ?>
            <tr>
                <td><?php echo $orderDetail->getUserId() ?></td>
                <td><?php echo $orderDetail->getUserName() ?></td>
                <td><?php echo $orderDetail->getProductDescription() ?></td>
                <td><?php echo $orderDetail->getTotalOrders() ?></td>
                <td><?php echo $orderDetail->getTotalAdminCosts() ?></td>
                <td><?php echo $orderDetail->getTotalClientCosts() ?></td>
            </tr>
        <?php } ?>

    </table>


</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir o produto ' + id + '?')) {
            location.href = '/public/index.php?action=destroyOrder&id=' + id;
        }
    }
</script>