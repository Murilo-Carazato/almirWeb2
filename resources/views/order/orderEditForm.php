<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Bll\ProductBll;
use App\Controllers\OrderController;

session_start();
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
    <link href="/../../../public/build/output.css" rel="stylesheet">
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Editar Pedidos</title>
</head>


<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <?php include('resources\views\components\navbar.php') ?>
    <div class="md:mx-60 w-2/3">
        <div class="mt-10 mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Atualize um pedido</h2>
            <!-- <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Este pedido ficará visível para usuários comprarem!</h2> -->
        </div>
        <form action="/public/index.php?action=updateOrder&id=<?php echo $order->getId(); ?>" method="POST">
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                <input name="date" value="<?php echo $order->getDate()->format('Y-m-d');; ?>" required type="date" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade comprada</label>
                <input name="quantity" value="<?php echo $order->getQuantity(); ?>" required type="number" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

            </div>

            <?php $bllProduct = new ProductBll(); ?>

            <label  class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alterar produto</label>
            <select  class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <?php
                $products = $bllProduct->getAllProducts();

                foreach ($products as $Product) { ?>
                    <option value="<?php echo $Product->getId(); ?>">
                        <?php echo $Product->getDescription() ?>
                    </option>
                <?php } ?>
            </select>
            <button type="submit" class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 duration-300 text-white font-semibold mb-2">Atualizar</button>
        </form>
        <p></p>
    </div>
    <script type="text/javascript" src="../../js/mode_switcher.js"></script>
</body>

</html>