<?php


?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <title>Inserir Produto</title>
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
            <form action="/public/index.php?action=createProduct" method="POST" class="col s12">
                
                <div class="input-field col s8">
                    <input placeholder="informe a descrição" id="description" name="description" type="text" class="validate">
                    <label for="description">Descrição</label>
                </div>
                
                <div class="input-field col s8">
                    <input placeholder="Informe a data de Vencimento" id="unitPrice" name="unitPrice" type="number" class="validate">
                    <label for="unitPrice">Preço Unitário</label>
                </div>

                <div class="input-field col s8">
                    <input placeholder="informe o estoque" id="stock" name="stock" type="number" class="validate">
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