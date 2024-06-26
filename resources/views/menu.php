<?php require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\ProductBll;

session_start();
$bllProduct = new ProductBll();
$products = $bllProduct->getAllProducts();

if (isset($_SESSION['currentUser'])) {
    $user = unserialize($_SESSION['currentUser']);
    $type = $user->getType();
}

if ($_GET['search']) {
    $search = $_GET['search'];

    $filteredProducts = [];

    foreach ($products as $key => $product) {
        if (str_contains(strtolower($product->getDescription()), strtolower($search))) {
            $filteredProducts[] = $product;
        }
    }

    $products = $filteredProducts;
}

?>

<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script>
        // On page load or when changing themes, best to add inline in `head` to avoid FOUC
        if (localStorage.getItem('color-theme') === 'dark' || (!('color-theme' in localStorage) && window.matchMedia('(prefers-color-scheme: dark)').matches)) {
            document.documentElement.classList.add('dark');
        } else {
            document.documentElement.classList.remove('dark')
        }
    </script>
    <link href="../../public/build/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <title>Inicio</title>
</head>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <div class="min-h-screen">
        <?php include_once('components/navbar.php') ?>
        <div class="antialiased" x-data="{
        cart:[], 
        init(){
            this.cart = JSON.parse(localStorage.getItem('cart'));
            if(!this.cart){
                this.cart = [];
            }
        },
        isOpen: false,
        repeated: false,
        addToCart(product){
            if(this.cart.length>0){
                for(let i=0; i < this.cart.length; i++){
                    if(product.id == this.cart[i].id){
                        this.repeated = true;
                    }
                }
            }
            if(!this.repeated){
                this.cart.push(product);
                localStorage.setItem('cart',JSON.stringify(this.cart));
            }
        },
        clearCart(){
            this.cart = [];
            localStorage.removeItem('cart');
        },
        getSizeOfCart(){
            if(!this.cart){
                return 0;
            }
            return this.cart.length;
        },
        deleteProduct(id){
            window.location.href = `http://localhost:8000/resources/views/product/deleteProduct.php?id=${id}`;
        },
        showProduct(id){
            window.location.href = `http://localhost:8000/resources/views/product/productEditForm.php?id=${id}`;
        },
        removeItemFromCart(index){
            // remove índice recebido do parâmetro da lista de compras
            this.cart.splice(index, 1);
            // sobrescreve localStorage com nova lista de compras
            localStorage.setItem('cart',JSON.stringify(this.cart));
        }}">

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
                <!-- SearchBar de produtos -->
                <div class="flex-row flex justify-between mt-10 gap-40 w-full py-2 mb-5">
                    <form class="w-full">
                        <label for="default-search" class="mb-2 text-sm font-medium text-gray-900 sr-only dark:text-white">Search</label>
                        <div class="relative">
                            <div class="absolute inset-y-1 start-0 flex items-center ps-3 pointer-events-none">
                                <svg class="w-4 h-4 text-gray-500 dark:text-gray-400" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 20 20">
                                    <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m19 19-4-4m0-7A7 7 0 1 1 1 8a7 7 0 0 1 14 0Z" />
                                </svg>
                            </div>
                            <input type="search" id="default-search" name="search" class="block w-full p-4 ps-10 text-sm text-gray-900 border border-gray-300 rounded-lg bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500" placeholder="Pesquise um produto..." value="<?php if (isset($search)) {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo $search;
                                                                                                                                                                                                                                                                                                                                                                                                                } else {
                                                                                                                                                                                                                                                                                                                                                                                                                    echo "";
                                                                                                                                                                                                                                                                                                                                                                                                                }  ?>" />
                            <button type="submit" class="text-white absolute end-2.5 bottom-2.5 bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-4 py-2 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">Pesquisar</button>
                        </div>
                    </form>
                    <div>
                        <!-- Dropdown toggle button -->
                        <button @click="cart.length>0 ? isOpen = !isOpen : ''" class="relative inline-flex items-center px-5 h-full text-sm font-medium text-white bg-indigo-700 rounded-lg hover:bg-indigo-800 focus:ring-4 dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-shopping-cart">
                                <circle cx="8" cy="21" r="1" />
                                <circle cx="19" cy="21" r="1" />
                                <path d="M2.05 2.05h2l2.66 12.42a2 2 0 0 0 2 1.58h9.78a2 2 0 0 0 1.95-1.57l1.65-7.43H5.12" />
                            </svg>
                            <div class="absolute inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900" x-text="getSizeOfCart()"></div>
                        </button>

                        <!-- Dropdown Carrinho -->
                        <div class="absolute right-0 z-20 w-64 mt-2 overflow-hidden origin-top-right bg-white rounded-md shadow-lg sm:w-80 dark:bg-gray-800" x-show="isOpen" @click.away="isOpen = !isOpen" x-transition:enter="transition ease-out duration-100" x-transition:enter-start="opacity-0 scale-90" x-transition:enter-end="opacity-100 scale-100" x-transition:leave="transition ease-in duration-100" x-transition:leave-start="opacity-100 scale-100" x-transition:leave-end="opacity-0 scale-90">
                            <div class="py-2">
                                <template x-for="(item, index) in cart" :key="index">
                                    <div class="flex justify-between items-center px-4 py-3 -mx-2 transition-all duration-300 transform border-b border-gray-100 hover:bg-gray-50 dark:hover:bg-gray-700 dark:border-gray-700">
                                        <div class="flex justify-evenly">
                                            <img class="flex-shrink-0 object-cover w-8 h-8 mx-1 rounded-full" :src="item.image" alt="avatar" />
                                            <div class="flex flex-col">
                                                <span class=" mx-2 text-gray-600 dark:text-white text-lg font-bold" x-text="item.title"></span>
                                                <span class="mx-2  text-blue-500 text-sm" x-text="item.price"></span>
                                            </div>
                                        </div>
                                        <!-- Delete item do carrinho -->
                                        <button @click="removeItemFromCart(index)" class="text-red-500 hover:text-white border border-red-500 hover:bg-red-500 focus:outline-none font-medium rounded-lg text-sm px-5 py-2.5 text-center me-2 mb-2 dark:text-red-500 dark:hover:text-white dark:hover:bg-red-600">
                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                                <path d="M3 6h18" />
                                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                                <line x1="10" x2="10" y1="11" y2="17" />
                                                <line x1="14" x2="14" y1="11" y2="17" />
                                            </svg>
                                        </button>
                                    </div>
                                </template>
                            </div>
                            <button class="block w-full py-2 font-bold text-center text-white bg-red-500 dark:bg-red-700 hover:dark:bg-red-800 hover:bg-red-600 hover:cursor-pointer" @click="clearCart(); isOpen = false">Limpar carrinho</button>
                            <a class="block w-full py-2 font-bold text-center bg-indigo-700 hover:bg-indigo-800 text-gray-200 hover:cursor-pointer" href="/resources/views/order/send_order.php">Finalizar compra</a>
                        </div>
                    </div>
                </div>


                <!-- Cards de produtos -->
                <?php if (count($products) < 1) { ?>
                    <h1 class="text-center my-10 text-gray-600 dark:text-gray-400">Nenhum produto encontrado...</h1>
                <?php } ?>
                <div class="grid grid-cols-3 gap-6">
                    <?php foreach ($products as $product) : ?>
                        <div class="relative w-full bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
                            <!-- Se usuário for admin, será redirecionado para update do produto -->
                            <a class="hover:cursor-pointer" <?php if ($type == 'admin') { ?> @click="showProduct(<?php echo $product->getId() ?>)" <?php } ?>>
                                <img class="p-5 rounded-t-lg" src="https://cdn.pixabay.com/photo/2016/11/19/18/06/feet-1840619_1280.jpg" alt="product image" />
                            </a>
                            <div class="px-5 pb-5">
                                <a>
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
                                    <button @click="addToCart({
                                        'id': <?php echo $product->getId() ?>,
                                        'image': 'https:cdn.pixabay.com/photo/2016/11/19/18/06/feet-1840619_1280.jpg',
                                        'title': '<?php echo $product->getDescription() ?>',
                                        'price': '<?php echo $product->getUnitPrice() ?>',
                                        'quantity': 1
                                });
                                 repeated=false" class="text-white bg-indigo-700 hover:bg-indigo-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-indigo-600 dark:hover:bg-indigo-700 dark:focus:ring-blue-800">Comprar</button>
                                </div>
                            </div>
                            <?php
                            if ($type == 'admin') { ?>
                                <div class="absolute hover:cursor-pointer inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900" @click="deleteProduct(<?php echo $product->getId() ?>)">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash">
                                        <path d="M3 6h18" />
                                        <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                        <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                                    </svg>
                                </div>
                            <?php } ?>
                        </div>
                    <?php endforeach ?>
                </div>
            </section>
        </div>

    </div>
    <?php include_once('components/footer.html') ?>
    <script type="text/javascript" src="../js/mode_switcher.js"></script>
</body>

</html>