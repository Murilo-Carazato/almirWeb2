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
        <div class="mt-10 mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-gray-900 dark:text-white">Atualize suas informações pessoais</h2>
            <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Preservamos sua privacidade e coletamos somente seu nome, legal né?</h2>
        </div>
        <form action="/public/index.php?action=updateUser&id=<?php echo $user->getId(); ?>" method="POST">
            <div class="mb-5">
                <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                <input id="name" name="name" minlength="2"  maxlength="30" value="<?php echo $user->getName(); ?>" required type="text" maxlength="30" class="transition-all bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">
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