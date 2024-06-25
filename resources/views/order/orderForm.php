<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Bll\ProductBll;
use App\Models\Order;


// date_default_timezone_set('America/Sao_Paulo');
// $order = new Order;
// $dateString = date("Y-m-d H:i:s");
// $date = new DateTime($dateString);
// $order->setDate($date);
// var_dump($order->getDate());
// die();
?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <title>Inserir Pedido</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/init.js"></script>
</head>

<body>
    <?php //include_once '../menu.php'; 
    ?>
    <div class="container indigo lighten-4 deep-orange-text col s12">
        <div class="center green">
            <h1>Inserir Receita</h1>
        </div>
        <div class="row black-text">
            <form action="/public/index.php?action=createOrder" method="POST" class="col s12">

                <div class="input-field col s8">
                    <input placeholder="informe a data" id="date" name="date" type="date" class="validate">
                    <label for="date">Data</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="informe a quantidade requisitada" id="quantity" name="quantity" type="number" class="validate">
                    <label for="quantity">Quantidade</label>
                </div>

                <div class="input-field col s5">
                    <select name="productId">
                        <option value="" disabled selected>Escolha um produto</option>

                        <?php
                        $bllProduct = new ProductBll();
                        $products = $bllProduct->getAllProducts();

                        foreach ($products as $Product) { ?>

                            <option value="<?php echo $Product->getId(); ?>">
                                <?php echo $Product->getDescription() ?>
                            </option>
                        <?php } ?>


                    </select>
                    <label>Informe o Produto requisitado</label>
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