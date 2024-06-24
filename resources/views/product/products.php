<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\ProductController;
use App\Controllers\SessionController;

$productController = new ProductController();
$sessionController = new SessionController();

$data = $productController->index();
$userId = $sessionController->getCurrentUserId();
$products = $data;
?>

<!DOCTYPE html>
<html lang="pt-BR">

<head>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/css/materialize.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/materialize/1.0.0/js/materialize.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Listar Products</title>
</head>

<body>
    <h1>Listar Products</h1>
    <table class="highlight">
        <tr>
            <th>ID</th>
            <th>Descrição</th>
            <th>Preço Unitário</th>
            <th>Estoque</th>
            <th>IdUser</th>
        </tr>

        <?php foreach ($products as $product) { ?>
            <tr>
                <td><?php echo $product->getId(); ?></td>
                <td><?php echo $product->getDescription(); ?></td>
                <td><?php echo $product->getUnitPrice(); ?></td>
                <td><?php echo $product->getStock(); ?></td>
                <td><?php echo $product->getUserId(); ?></td>

                <?php if ($userId == $product->getUserId()) { ?>
                    <td>
                        <a class="btn-floating btn-small waves-effect waves-light orange" onclick="JavaScript:location.href='/resources/views/product/productEditForm.php?id=' + '<?php echo $product->getId(); ?>'">
                            <i class="material-icons">edit</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light blue" onclick="JavaScript:location.href='/resources/views/product/productDetails.php?id=' + '<?php echo $product->getId(); ?>'"><i class="material-icons">details</i></a>

                        <a class="btn-floating btn-small waves-effect waves-light red" onclick="JavaScript: remover( <?php echo $product->getId(); ?> )">
                            <i class="material-icons">delete</i></a>
                    </td>
                <?php } ?>
            </tr>
        <?php } ?>

    </table>

    <button class="waves-effect waves-light btn green" type="button" onclick="JavaScript:location.href='/resources/views/product/productForm.php'"><i class="material-icons">add</i>
    </button>
</body>

</html>

<script>
    function remover(id) {
        if (confirm('Excluir o produto ' + id + '?')) {
            location.href = '/public/index.php?action=destroyProduct&id=' + id;
        }
    }
</script>
