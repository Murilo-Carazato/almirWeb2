<?php

require_once __DIR__ . '/../../vendor/autoload.php';

?>
<!DOCTYPE html>
<html lang="pt-Br">

<head>
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>

    <link href="../../public/build/output.css" rel="stylesheet">
    <title>Login</title>
</head>

<body>
    <style>
        .login_img_section {
            background: linear-gradient(rgba(2, 2, 2, .7), rgba(0, 0, 0, .7)), url(https://images.unsplash.com/photo-1524989899036-b1c54afba1c0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) center center;
        }
    </style>

    <div class="h-screen flex">
        <div class="hidden lg:flex w-full lg:w-1/2 login_img_section
            justify-around items-center">

            <div class="w-full mx-auto px-20 flex-col items-center space-y-6">
                <h1 class="text-white font-bold text-4xl font-sans">TrendyShop</h1>
                <p class="text-white mt-1">O seu centro de compras!</p>
                <div class="flex justify-center lg:justify-start mt-6">
                    <button id="theme-toggle" type="button" class="text-gray-500 dark:text-gray-400 hover:bg-gray-100 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5">
                        <svg id="theme-toggle-dark-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M17.293 13.293A8 8 0 016.707 2.707a8.001 8.001 0 1010.586 10.586z"></path>
                        </svg>
                        <svg id="theme-toggle-light-icon" class="hidden w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg">
                            <path d="M10 2a1 1 0 011 1v1a1 1 0 11-2 0V3a1 1 0 011-1zm4 8a4 4 0 11-8 0 4 4 0 018 0zm-.464 4.95l.707.707a1 1 0 001.414-1.414l-.707-.707a1 1 0 00-1.414 1.414zm2.12-10.607a1 1 0 010 1.414l-.706.707a1 1 0 11-1.414-1.414l.707-.707a1 1 0 011.414 0zM17 11a1 1 0 100-2h-1a1 1 0 100 2h1zm-7 4a1 1 0 011 1v1a1 1 0 11-2 0v-1a1 1 0 011-1zM5.05 6.464A1 1 0 106.465 5.05l-.708-.707a1 1 0 00-1.414 1.414l.707.707zm1.414 8.486l-.707.707a1 1 0 01-1.414-1.414l.707-.707a1 1 0 011.414 1.414zM4 11a1 1 0 100-2H3a1 1 0 000 2h1z" fill-rule="evenodd" clip-rule="evenodd"></path>
                        </svg>
                    </button>
                </div>
            </div>
        </div>
        <div class="flex w-full lg:w-1/2 justify-center items-center bg-white dark:bg-gray-950 space-y-8 transition-all">
            <div class="w-full px-8 md:px-32 lg:px-24 ">
                <form class="bg-white dark:bg-gray-900 shadow-lg shadow-gray-500 dark:shadow-black rounded-md p-5 duration-300" method="post" action="/public/index.php?action=loginUser">
                    <h1 class="text-gray-800 dark:text-gray-200 font-bold text-2xl mb-1">Login</h1>
                    <p class="text-sm font-normal text-gray-600 dark:text-gray-400 mb-8">Bem-vindo de volta!</p>

                    <!-- Inserir nome -->
                    <label for="name" class="block mb-2 text-sm font-medium text-gray-900 dark:text-white">Nome</label>
                    <input id="name" type="text" name="name" required placeholder="Digite seu nome" class="duration-300 rounded-lg bg-gray-50 border border-gray-300 text-gray-900 focus:ring-indigo-500 focus:border-indigo-500 block flex-1 min-w-0 w-full text-sm p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">

                    <!-- Inserir senha -->
                    <label for="password" class="mt-5 block mb-2 text-sm font-medium text-gray-900 dark:text-white">Senha</label>
                    <input type="password" id="password" name="password" placeholder="Digite sua senha" required class="duration-300 bg-gray-50 border border-gray-300 text-gray-900 text-sm rounded-lg focus:ring-indigo-500 focus:border-indigo-500 block w-full p-2.5  dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-indigo-500 dark:focus:border-indigo-500">


                    <button type="submit" name="action" class="block w-full bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 text-white font-semibold mb-2 duration-300">Entrar</button>
                    <div class="flex justify-between mt-4">
                        <span class="text-sm ml-2 hover:text-indigo-500 dark:text-gray-300 cursor-pointer hover:-translate-y-1 duration-500">Esqueceu
                            a senha?</span>

                        <a href="register.php" class="text-sm ml-2 hover:text-indigo-500 dark:text-gray-300 cursor-pointer hover:-translate-y-1 duration-500">Não
                            possui uma conta?</a>
                    </div>

                </form>
            </div>

        </div>
    </div>
    <?php ?>
    <script type="text/javascript" src="../js/mode_switcher.js"></script>
</body>

</html>