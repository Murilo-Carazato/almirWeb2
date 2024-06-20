<?php

// require_once __DIR__ . '/../../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <link href="../../public/build/output.css" rel="stylesheet">
    <title>Inserir Equipamentos</title>
    <script src="https://code.jquery.com/jquery-3.7.1.js" integrity="sha256-eKhayi8LEQwp4NKxN+CfCh+3qOVUtJn3QNZ0TciWLP4=" crossorigin="anonymous"></script>
    <script type="text/javascript" src="../js/init.js"></script>
</head>

<body>
    <?php //include_once '../menu.php'; 
    ?>
    <div class="container indigo lighten-4 deep-orange-text col s12">
        <div class="center green">
            <h1>Inserir Equipamento</h1>
        </div>
        <div class="row black-text">
            <form action="/public/index.php?action=postUser" method="POST" class="col s12">
                <div class="input-field col s8">
                    <input placeholder="Nome de Usuário" id="name" name="name" class="validate">
                    <label for="name">Nome de Usuário</label>
                </div>
                <div class="input-field col s8">
                    <input placeholder="Senha" id="password" name="password" class="validate">
                    <label for="password">Senha</label>
                </div>

                <div class="brown lighten-3 center col s12">
                    <br>
                    <button class="waves-effect waves-light btn green" type="submit">
                        Gravar <i class="material-icons">save</i>
                    </button>
                    <button class="waves-effect waves-light btn red" type="reset">
                        Limpar <i class="material-icons">clear_all</i>
                    </button>
                    <button class="waves-effect waves-light btn blue" type="button" onclick="JavaScript:location.href='lstEquipamento.php'">
                        Voltar <i class="material-icons">arrow_back</i>
                    </button>
                    <br>
                    <br>
                </div>
            </form>

        </div>
    </div>
</body>

</html>