<?php
require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\ProductBll;

$bllProduct = new ProductBll();

$products = $bllProduct->Select();
?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/build/output.css" rel="stylesheet">

    <title>Inicio</title>
</head>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <div class="min-h-screen">
        <div class="antialiased">
            <?php include('resources\views\components\navbar.html') ?>
            <div class="bg-white border-gray-200 shadow-sm border-y dark:bg-gray-800 dark:border-gray-600">
                <div class="grid max-w-screen-xl px-4 py-5 mx-auto text-sm text-gray-500 dark:text-gray-400 md:grid-cols-3 md:px-6">
                    <ul class="hidden mb-4 space-y-4 md:mb-0 md:block " aria-labelledby="mega-menu-full-image-button">
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Nossos parceiros
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Segmentação
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Marketing CRM
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Nossas franquias
                            </a>
                        </li>
                    </ul>
                    <ul class="mb-4 space-y-4 md:mb-0">
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Nosso blog
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Termos e condições
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Licenças
                            </a>
                        </li>
                        <li>
                            <a href="#" class="text-gray-500 dark:text-gray-400 duration-300 hover:text-indigo-500 dark:hover:text-indigo-500 hover:underline">
                                Trabalhe conosco
                            </a>
                        </li>
                    </ul>
                    <a href="#" class="p-8 bg-local bg-gray-500 bg-center bg-no-repeat bg-cover rounded-lg bg-blend-multiply" style="background-image: url(https://images.unsplash.com/photo-1472851294608-062f824d29cc?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D)">
                        <p class="max-w-xl mb-5 font-extrabold leading-tight tracking-tight text-white">Tem alguma dúvida ou sugestão? Entre em contato!</p>
                        <button type="button" class="inline-flex items-center px-2.5 py-1.5 text-xs font-medium text-center text-white border border-white rounded-lg hover:bg-white hover:text-gray-900 focus:ring-4 focus:outline-none focus:ring-gray-700">
                            Falar com um atendente
                            <svg class="w-3 h-3 ms-2 rtl:rotate-180" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 10">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M1 5h12m0 0L9 1m4 4L9 9" />
                            </svg>
                        </button>
                    </a>
                </div>
            </div>
            <section class="w-full max-w-7xl lg:px-8 sm:px-6 mx-auto mb-10">
                <!-- SearchBar de produos -->
                <div class="flex-row flex justify-between mt-10 gap-40 w-full py-2 mb-5">
                    <form class="w-full">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-1 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pesquise um produto..." required />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">Pesquisar</button>
                        </div>
                    </form>
                    <button type="button" class="relative inline-flex items-center px-5 text-sm font-medium text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart">
                            <circle cx="8" cy="21" r="1" />
                            <circle cx="19" cy="21" r="1" />
                            <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                        </svg>

                        <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900">8</div>
                    </button>
                </div>


                <!-- Cards de produtos -->
                <div class="grid grid-cols-3 gap-6">
                    <?php foreach ($products as $product) : ?>
                        <div class="w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <a href="#">
                                <img class="p-5 rounded-t-lg" src="https://cdn.pixabay.com/photo/2016/11/19/18/06/feet-1840619_1280.jpg" alt="product image" />
                            </a>
                            <div class="px-5 pb-5">
                                <a href="#">
                                    <h5 class="text-xl font-semibold tracking-tight text-gray-900 dark:text-white uppercase"><?php echo $product->getDescription() ?></h5>
                                </a>
                                <div class="flex items-center mt-2.5 mb-5">
                                    <div class="flex items-center space-x-1 rtl:space-x-reverse">
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-yellow-300" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                        <svg class="w-4 h-4 text-gray-200 dark:text-gray-600" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="currentColor" viewBox="0 0 22 20">
                                            <path d="M20.924 7.625a1.523 1.523 0 0 0-1.238-1.044l-5.051-.734-2.259-4.577a1.534 1.534 0 0 0-2.752 0L7.365 5.847l-5.051.734A1.535 1.535 0 0 0 1.463 9.2l3.656 3.563-.863 5.031a1.532 1.532 0 0 0 2.226 1.616L11 17.033l4.518 2.375a1.534 1.534 0 0 0 2.226-1.617l-.863-5.03L20.537 9.2a1.523 1.523 0 0 0 .387-1.575Z" />
                                        </svg>
                                    </div>
                                    <span class="bg-blue-50 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-gray-700 dark:text-blue-400 ms-3">4.0</span>
                                </div>
                                <div class="flex items-center justify-between">
                                    <span class="text-3xl font-bold text-gray-900 dark:text-white"><?php echo '$' . $product->getUnitPrice() ?></span>
                                    <a href="#" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">Comprar</a>
                                </div>
                            </div>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        </div>

    </div>
    <?php include('resources\views\components\footer.html') ?>
    <script type="text/javascript" src="../js/mode_switcher.js"></script>
</body>

</html>