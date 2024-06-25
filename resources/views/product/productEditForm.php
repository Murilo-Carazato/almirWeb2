<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\ProductController;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $productController = new ProductController();
    $product = $productController->show($id);
} else {
    die("ID inválido.");
}
?>

<!DOCTYPE html>
<html lang="pt-Br">
<script>
    const mascaraMoeda = (event) => {
        const onlyDigits = event.target.value
            .split("")
            .filter(s => /\d/.test(s))
            .join("")
            .padStart(3, "0")
        const digitsFloat = onlyDigits.slice(0, -2) + "." + onlyDigits.slice(-2)
        event.target.value = maskCurrency(digitsFloat)
    }

    const maskCurrency = (valor, locale = 'pt-BR', currency = 'BRL') => {
        return new Intl.NumberFormat(locale, {
            style: 'currency',
            currency
        }).format(valor)
    }
</script>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="/../../../public/build/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Editar Produtos</title>
</head>


<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <?php include('resources\views\components\navbar.php') ?>
    <div class="mx-60">
        <div class="mt-10 mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Atualize um produto</h2>
            <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Este produto ficará visível para usuários comprarem!</h2>
        </div>
        <form action="/public/index.php?action=updateProduct&id=<?php echo$product->getId(); ?>" method="POST" x-data="{
            unitPrice : <?php echo$product->getUnitPrice(); ?>,
            unitPriceMask: 'R$ <?php echo$product->getUnitPrice(); ?>',
            castUnitPrice(){
                let stringLimpada = this.unitPriceMask.replace(/R\$|\s/g, '');
                stringLimpada = stringLimpada.replace(/\./g, '');
                stringLimpada = stringLimpada.replace(',', '.');
                stringLimpada = stringLimpada.replace(' ', '');
                this.unitPrice = parseFloat(stringLimpada);
            }
        }">
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Descrição</label>
                <input name="description" value="<?php echo $product->getDescription(); ?>" required type="text" maxlength="30" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Preço (unitário)</label>
                <input name="unitPrice" value="<?php echo $product->getUnitPrice(); ?>" required @input="castUnitPrice()" x-model="unitPriceMask" type="text" oninput="mascaraMoeda(event);"  class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
                <!-- <input type="hidden" x-model="unitPrice" name="unitPrice"> -->
            </div>
            <div class="mb-5">
                <label class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Quantidade em estoque</label>
                <input name="stock" value="<?php echo $product->getStock(); ?>" required type="number" class="bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

            </div>
            <button type="submit" class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 duration-300 text-white font-semibold mb-2">Atualizar</button>
        </form>
        <p></p>
    </div>
    <script type="text/javascript" src="../../js/mode_switcher.js"></script>
</body>

</html>