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

$bllProduct = new ProductBll();
$products = $bllProduct->getAllProducts();
?>

<!DOCTYPE html>
<html lang="pt-Br">

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
    <link href="../../../public/build/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Editar Pedidos</title>
</head>


<body class="bg-gray-50 dark:bg-gray-950 overflow-x-auto transition-all">
    <?php include('..\components\navbar.php') ?>
    <div class="md:mx-60 w-2/3 flex flex-col items-start">
        <div class="mt-10 mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Atualize um pedido</h2>
            <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Atualize o pedido alterando as informações que necessitar!</h2>
        </div>
        <form id="orderForm" action="/public/index.php?action=updateOrder&id=<?php echo $order->getId(); ?>" method="POST" class="w-full">
            <div class="mb-5">
                <label for="input-date" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Data</label>
                <input id="input-date" name="date" value="<?php echo $order->getDate()->format('Y-m-d');; ?>" required type="date" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            </div>
            <div class="mb-5">
                <label for="input-quantity" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade comprada</label>
                <input id="input-quantity" name="quantity" value="<?php echo $order->getQuantity(); ?>" min="0" required type="number" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            </div>
            <label for="select-product" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Alterar produto</label>
            <select name="productId" id="select-product" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <?php
                $selectedProductId = $order->getProductId();
                foreach ($products as $Product) {
                    if ($Product->getId() == $selectedProductId) {
                        $selected = 'selected';
                    } else {
                        $selected = '';
                    }
                ?>
                    <option value="<?php echo $Product->getId(); ?>" data-stock="<?php echo ($Product->getStock() + $order->getQuantity()); ?>" <?php echo $selected; ?>>
                        <?php echo $Product->getDescription(); ?>
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

<script>
    //valor inicial do select está errado

    //qnt comprada antiga + stock do produto escolhido antigo
    //setStock ($order->getQuantity(); + $order->product->stock)

    document.addEventListener('DOMContentLoaded', (event) => {
        const selectProduct = document.getElementById('select-product');
        const inputQuantity = document.getElementById('input-quantity');

        selectProduct.addEventListener('change', (event) => {
            const selectedOption = selectProduct.options[selectProduct.selectedIndex];
            const stock = selectedOption.getAttribute('data-stock');
            inputQuantity.setAttribute('max', stock);

            //

            var oldProductChosen = <?php echo $order->getProductId(); ?>;
            //comparar o atual com o antigo
            console.log('Selected Product ID:', selectedOption.value); //atual
            console.log('oldProductChosen ID:', oldProductChosen); //antigo
            console.log('Stock:', stock);

            var form = document.getElementById('orderForm');
            if (oldProductChosen != selectedOption.value) {
                console.log('TROCOU O PRODUTO ORIGINAL');
                form.action = '/public/index.php?action=updateOrder&id=<?php echo $order->getId(); ?>&idDoProdutoAntigo=' + oldProductChosen;
            }
        });

        selectProduct.dispatchEvent(new Event('change'));
    });
</script>