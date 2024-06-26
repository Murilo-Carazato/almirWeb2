<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\OrderController;
use App\Controllers\SessionController;
use App\Dal\OrderDal;
session_start();
$orderController = new OrderController();
$sessionController = new SessionController();

// $orders = $orderController->index();
// $userId = $sessionController->getCurrentUserId();
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
        TotalPrice(price){
            let formattedPrice = price.toLocaleString('pt-BR', {
                style: 'currency',
                currency: 'BRL'
            });
            return formattedPrice;
        }
    }">
        <h2 class="text-2xl font-bold tracking-tight text-left text-gray-900 dark:text-white my-8">Histórico de pedidos</h2>
        <div class="relative overflow-x-auto shadow-lg sm:rounded-lg border border-t-gray-200 dark:border-0 border-b-inherit dark:border-b-transparent">
            <table class="w-full text-sm text-left rtl:text-right text-gray-500 dark:text-gray-400 mt-2">
                <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                    <tr>
                        <th scope="col" class="px-6 py-3">
                            ID
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Data
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Quantidade
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Valor Total
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Produto
                        </th>
                        <th scope="col" class="px-6 py-3">
                            Actions
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <?php 
                    
                    foreach ($orderDetails as $order) { ?>
                        <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
                            <th scope="row" class="px-6 py-4 font-medium text-gray-900 whitespace-nowrap dark:text-white"><?php echo $order->getUserId(); ?></th>
                            <td class="px-6 py-4">
                                <?php echo $order->getTotalClientCosts() ?>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php echo $order->getTotalOrders() ?></td>
                            <td class="px-6 py-4">
                                <span x-text="TotalPrice(<?php echo$order->getTotalAdminCosts()?>)"></span>
                            </td>
                            <td class="px-6 py-4 text-center">
                                <?php echo $order->getProductDescription(); ?>
                            </td>

                            <?php if ($userId == $order->getUserId()) { ?>
                                <td class="px-6 py-4 text-left rtl:text-right">
                                    <a class="font-medium text-yellow-600 dark:text-yellow-500  hover:cursor-pointer" onclick="JavaScript:location.href='/resources/views/order/orderEditForm.php?id=' + '<?php echo $order->getUserId(); ?>'">
                                        <span class="hover:underline">Editar</span>
                                    </a>
                                    <a class="font-medium text-indigo-600 dark:text-indigo-500  hover:cursor-pointer" onclick="JavaScript:location.href='/resources/views/order/orderDetails.php?id=' + '<?php echo $order->getUserId(); ?>'">
                                        <span class="hover:underline">Ver</span>
                                    </a>
                                    <a class="font-medium text-red-600 dark:text-red-500  hover:cursor-pointer" onclick="JavaScript: remover( <?php echo $order->getUserId(); ?> )">
                                        <span class="hover:underline">Excluir</span>
                                    </a>
                                </td>
                            <?php } ?>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
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