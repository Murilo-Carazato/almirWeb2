<?php
require_once __DIR__ . '/../../../vendor/autoload.php';

use App\Controllers\UserController;

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $userController = new UserController();
    $user = $userController->show($id);
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
    <title>Editar perfil</title>
</head>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-auto transition-all">
    <?php include('resources\views\components\navbar.php') ?>
    <div class="md:mx-60 mx-20">
        <div class="flex flex-row justify-between w-full items-end mt-10 mb-5">
            <div class=" flex flex-col">
                <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Atualize suas informações pessoais</h2>
                <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Preservamos sua privacidade e coletamos somente seu nome, legal né?</h2>
            </div>
            <a onclick="JavaScript: remover(<?php echo $user->getId(); ?>)" class="transition-all hover:cursor-pointer h-2/3 items-center text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center inline-flex me-2 dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-800">
                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash">
                    <path d="M3 6h18" />
                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                </svg>
                Excluir conta
            </a>
        </div>

        <form action="/public/index.php?action=updateUser&id=<?php echo $user->getId(); ?>" method="POST">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                <input id="name" name="name" minlength="2" maxlength="30" value="<?php echo $user->getName(); ?>" required type="text" maxlength="30" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
            </div>
            <div class="mb-5">
                <label for="type" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Tipo de usuário (admin ou client)</label>
                <input id="type" name="type" value="<?php echo $user->getType(); ?>" required type="text" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

            </div>
            <button type="submit" class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 duration-300 text-white font-semibold mb-2">Atualizar</button>
        </form>
        <p></p>
    </div>
    <script type="text/javascript" src="../../js/mode_switcher.js"></script>
</body>

</html>
<script>
    function remover(id) {
        if (confirm('Tem certeza que deseja excluir sua conta?')) {
            location.href = '/public/index.php?action=destroyUser&id=' + id;
        }
    }
</script>