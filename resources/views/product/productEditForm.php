<?php

require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Bll\ProductBll;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $bllProduct = new ProductBll();
    $product = $bllProduct->SelectById($id);
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

    <title>Editar Products</title>
</head>

<body>
    <div class="container indigo lighten-4 deep-orange-text col s12">
        <div class="center green">
            <h1>Editar Product</h1>
        </div>
        <div class="row  black-text">
            <form action="/public/index.php?action=editProduct&id=<?php echo $product["id"]; ?>" method="POST" class="col s12">

                <!-- <div class="input-field col s8">
                    <input type="hidden" name="txtID" value=<?php //echo $id; 
                                                            ?>>
                </div> -->

                <div class="input-field col s8">
                    <input placeholder="informe a descrição" id="description" name="description" type="text" class="validate" value="<?php echo $product["description"]; ?>">
                    <label for="description">Descrição</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="Informe a data de Vencimento" id="unitPrice" name="unitPrice" type="number" class="validate" value="<?php echo $product["unit_price"]; ?>">
                    <label for="unitPrice">Preço Unitário</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="informe o estoque" id="stock" name="stock" type="number" class="validate" value="<?php echo $product["stock"]; ?>">
                    <label for="stock">Estoque</label>
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