<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\OrderController;
use App\Controllers\SessionController;
use App\Dal\OrderDal;

session_start();
$orderController = new OrderController();
$sessionController = new SessionController();

$orders = $orderController->index();
$userId = $sessionController->getCurrentUserId();
$dal = new OrderDal;
$orderDetails = $dal->ShowOrderDetails();
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <title>Meus pedidos</title>
    <link href="../../../public/build/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
</head>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <?php include('.\resources\views\components\navbar.php') ?>
    <div class="flex flex-col items-center min-h-screen" x-data="{
        init(){
            this.clearCart();
        },
        clearCart(){
            this.cart = [];
            localStorage.removeItem('cart');
        },
        TotalPrice(price){
            let formattedPrice = price.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            return formattedPrice;
        }
    }">

        <?php
        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            $type = $user->getType();
        }
        if ($type == 'admin') {
        ?>
            <h2 class="text-2xl font-bold tracking-tight text-left text-gray-900 dark:text-white my-8">Histórico de pedidos</h2>
            <div class="flex flex-col items-start w-2/3 mb-6">
                <h3 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300 ">Informações para administrador</h3>
                <div class="relative overflow-x-auto w-full shadow-lg dark:shadow-none sm:rounded-lg border border-t-gray-200 dark:border-0">
                    <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">
                                    Comprador
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Produto
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Quantidade de pedidos
                                </th>
                                <th scope="col" class="px-6 py-3">
                                    Valor Total
                                </th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php

                            foreach ($orderDetails as $order) { ?>
                                <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                    <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                        <?php echo $order->getUserName(); ?>
                                    </th>
                                    <td class="px-6 py-4">
                                        <?php echo $order->getProductDescription(); ?>
                                    </td>
                                    <td class="px-6 py-4">
                                        <?php echo $order->getTotalOrders() ?></td>
                                    <td class="px-6 py-4">
                                        <span x-text="TotalPrice(<?php echo $order->getTotalAdminCosts() ?>)"></span>
                                    </td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>

        <?php } ?>

        <div class="flex flex-col items-start w-2/3">
            <h3 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300 ">Informações para pedidos de <?php $user = unserialize($_SESSION['currentUser']);
                                                                                                                            echo $user->getName() ?></h3>
            <div class="relative overflow-x-auto w-full shadow-lg dark:shadow-none sm:rounded-lg border border-t-gray-200 dark:border-0 mb-20">
                <table class="w-full text-sm text-center rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                    <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                        <tr>
                            <th scope="col" class="px-6 py-3">
                                PRODUTO ID
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Data
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Quantidade
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Preço total
                            </th>
                            <th scope="col" class="px-6 py-3">
                                Ações
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php

                        foreach ($orders as $order) { ?>
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                                <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                    <?php echo $order->getProductId(); ?>
                                </th>
                                <td class="px-6 py-4">
                                    <?php echo $order->getDate()->format('d/m/Y H:i'); ?>
                                </td>
                                <td class="px-6 py-4">
                                    <?php echo $order->getQuantity() ?></td>
                                <td class="px-6 py-4">
                                    <span x-text="TotalPrice(<?php echo $order->getTotalPrice() ?>)"></span>
                                </td>
                                <td class="px-6 py-4 hover:cursor-pointer">
                                    <a class="font-medium text-yellow-600 dark:text-yellow-500" onclick="JavaScript:location.href='/resources/views/order/orderEditForm.php?id=' + '<?php echo $order->getId(); ?>'">
                                        <span class="hover:underline hover:text-">Editar</span> 
                                    </a>
                                    <!-- DEVEMOS ALTERAR O echo $order->getProductId(); PARA echo $order->getOrderId(); -->
                                    <!-- <a class="font-medium text-red-600 dark:text-red-500" onclick="JavaScript: remover( <?php //echo $order->getProductId(); ?> )">
                                        <span class="hover:underline hover:text-">Excluir</span> 
                                    </a> -->
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <?php include('.\resources\views\components\footer.html') ?>
    <script type="text/javascript" src="../../js/mode_switcher.js"></script>
</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir o produto ' + id + '?')) {
            location.href = '/public/index.php?action=destroyOrder&id=' + id;
        }
    }
</script>