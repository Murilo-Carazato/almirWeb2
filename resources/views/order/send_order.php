<?php session_start(); ?>
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
    <title>Finalizar Pedido</title>
    <link href="../../../public/build/output.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>

</head>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <?php include('.\resources\views\components\navbar.php') ?>
    <div class="flex items-center justify-center">
    <div class="flex flex-col items-start justify-center w-1/2" x-data="{
        cart: [],
        init(){
            this.cart = JSON.parse(localStorage.getItem('cart'));
            if(!this.cart){
                this.cart = [];
            }
        },
        removeItemFromCart(index){
            // remove índice recebido do parâmetro da lista de compras
            this.cart.splice(index, 1);
            // sobrescreve localStorage com nova lista de compras
            localStorage.setItem('cart',JSON.stringify(this.cart));
        },
        totalPrice(){
            let total = 0;
            for(let i=0; i<this.cart.length; i++){
                total += parseFloat(this.cart[i].price*this.cart[i].quantity);
            }
                return total.toLocaleString('pt-BR', {
                                        style: 'currency',
                                        currency: 'BRL',
              });
        },
        increase(index){
            this.cart[index].quantity++;
            localStorage.setItem('cart',JSON.stringify(this.cart));
        },
        decrease(index){
            if(this.cart[index].quantity>1){
                this.cart[index].quantity--;
                localStorage.setItem('cart',JSON.stringify(this.cart));
            }
        }
    }">
        <div class="mt-10 mb-5">
            <h2 class="text-2xl font-bold tracking-tight text-left text-gray-900 dark:text-white">Finalizar pedido</h2>
            <h2 class="text-base font-medium tracking-tight text-gray-500 dark:text-gray-300">Revise e confirme seu pedido abaixo!</h2>
        </div>
        <form action="/public/index.php?action=createOrder" method="POST" class="w-full">
            <template x-for="(item, index) in cart" :key="index">
                <div class="mb-3">
                    <a class="relative flex flex-col items-center border border-gray-200 rounded-lg shadow-md md:flex-row md:h-32 md:max-w-3xl hover:bg-gray-100 dark:border-gray-700 dark:bg-gray-800 dark:hover:bg-gray-700">
                        <img class="rounded-t-lg md:w-48 md:rounded-none md:rounded-s-lg" :src="item.image" alt="">
                        <div class="flex flex-row w-full justify-between items-center p-4 leading-normal">
                            <span class="font-normal text-gray-700 dark:text-gray-400 uppercase" x-text="item.title"></span>
                            <span class="font-bold text-gray-900 dark:text-gray-300" x-text="'$'+(item.price * parseFloat(item.quantity))"></span>
                            <div class="flex flex-col gap-1 dark:text-white">
                                <svg @click="increase(index)" class="rounded-xl bg-gray-200 dark:bg-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-up">
                                    <path d="m18 15-6-6-6 6" />
                                </svg>
                                <svg @click="decrease(index)" class="rounded-xl bg-gray-200 dark:bg-gray-900" xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-chevron-down">
                                    <path d="m6 9 6 6 6-6" />
                                </svg>
                            </div>
                        </div>
                        <div class="absolute hover:cursor-pointer inline-flex items-center justify-center w-6 h-6 text-xs font-bold text-white bg-red-500 border-2 border-white rounded-full -top-2 -end-2 dark:border-gray-900" @click="removeItemFromCart(index)">
                            <svg xmlns="http://www.w3.org/2000/svg" width="12" height="12" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash">
                                <path d="M3 6h18" />
                                <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6" />
                                <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2" />
                            </svg>
                        </div>
                        <span class="absolute bottom-0 right-0 m-1 inline-flex items-center justify-center w-6 h-6 text-xs rounded-full bg-gray-200 dark:bg-gray-900 dark:text-white" x-text="item.quantity"></span>
                    </a>
                </div>
            </template>
            <input type="hidden" :value="JSON.stringify(cart)" name="cart" class="bg-red-500">
            <div class="flex flex-row w-full md:max-w-3xl justify-between">
                <h3 class="text-sm font-medium tracking-tight text-gray-400 dark:text-gray-400">Está tudo certo? Clique para concluir sua compra.</h3>
                <div class="flex flex-row text-base font-medium tracking-tight text-gray-500 dark:text-gray-300 gap-1">
                    <p>Total: </p>
                    <span x-text="totalPrice()"></span>
                </div>
            </div>
            <button type="submit" class="block mb-28 w-full md:max-w-3xl bg-indigo-600 mt-5 py-2 rounded-2xl hover:bg-indigo-700 hover:-translate-y-1 duration-300 text-white font-semibold">Confirmar</button>
        </form>
    </div>
    </div>
    <?php include('.\resources\views\components\footer.html') ?>
    <script type="text/javascript" src="../../js/mode_switcher.js"></script>
</body>

</html>