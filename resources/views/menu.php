<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="../../public/build/output.css" rel="stylesheet">

    <title>Inicio</title>
</head>
<style>
    .login_img_section {
        opacity: 0.8;
        background: linear-gradient(rgba(30, 27, 75, 1), rgba(0, 0, 0, 0.6)), url(https://images.unsplash.com/photo-1612010167108-3e6b327405f0?q=80&w=1170&auto=format&fit=crop&ixlib=rb-4.0.3&ixid=M3wxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8fA%3D%3D) center center;
    }

    [x-cloak] {
        display: none !important;
    }
</style>

<body class="bg-gray-50 dark:bg-gray-950 overflow-x-hidden transition-all">
    <div class="min-h-screen">
        <div class="antialiased">
        <?php include('resources\views\components\navbar.html') ?>
            <div class="p-10">
                <div class="login_img_section text-white p-5 rounded-lg shadow-lg shadow-slate-500 dark:shadow-slate-800">
                    <h2 class=" font-bold text-3xl sm:text-4xl md:text-[40px] text-dark mb-4 mt-6">
                        Bem-vindo(a)!
                    </h2>
                    <p class="font-semibold text-lg mb-2 mt-10">
                        Controle suas Finanças de Forma Simples e Eficiente
                    </p>
                    <p class="text-base my-5 w-3/4">
                        No FinanGE, entendemos que gerenciar suas finanças pode ser um desafio. Por isso, criamos uma plataforma intuitiva e prática para ajudá-lo a acompanhar suas receitas e despesas, garantindo um controle financeiro mais eficiente e uma vida financeira mais saudável.
                    </p>
                </div>
                <div x-data="{ currentTab: 1 }" class="pt-10">
                    <button @click="currentTab = 1" :class="currentTab === 1 ? 'bg-gray-200 dark:bg-gray-900' : '' " class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4 focus:text-gray-900 dark:focus:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-950 dark:text-gray-200 focus:bg-gray-200 dark:focus:bg-gray-900 focus:outline-none focus:shadow-outline">Funcionalidades Principais</button>
                    <button @click="currentTab = 2" :class="currentTab === 2 ? 'bg-gray-200 dark:bg-gray-900' : '' " class="px-4 py-2 mt-2 text-sm font-semibold rounded-lg md:mt-0 md:ml-4 focus:text-gray-900 dark:focus:text-gray-200 hover:bg-gray-200 dark:hover:bg-gray-950 dark:text-gray-200 focus:bg-gray-200 dark:focus:bg-gray-900 focus:outline-none focus:shadow-outline">Benefícios do FinanGE</button>
                    <div>
                        <div x-show="currentTab === 1" x-cloak x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 translate-x-2/4">
                            <ul class="list-disc pl-5 text-gray-950 dark:text-gray-200 marker:text-gray-600 my-4 text-base">
                                <li class="pt-1.5">
                                    <a class="font-semibold">Registro de Receitas e Despesas:</a> <a>Adicione e categorize todas as suas fontes de renda e gastos de maneira rápida e fácil.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Visão Geral das Finanças:</a> <a>Tenha uma visão clara de sua situação financeira com gráficos e relatórios detalhados.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Metas e Orçamentos:</a> <a>Estabeleça metas financeiras e crie orçamentos mensais para manter suas finanças sob controle.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Alertas e Lembretes:</a> <a>Receba notificações sobre prazos de pagamento, metas a serem alcançadas e muito mais.</a>
                                </li>
                            </ul>
                        </div>
                        <div x-show="currentTab === 2" x-cloak x-transition:enter="transition ease-out duration-500" x-transition:enter-start="opacity-0 -translate-x-2/4">
                            <ul class="list-disc pl-5 text-gray-950 dark:text-gray-200 marker:text-gray-600 my-4 text-base">
                                <li class="pt-1.5">
                                    <a class="font-semibold">Simplicidade:</a> <a>Interface amigável e fácil de usar, adequada para todos os níveis de conhecimento.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Controle Total:</a> <a>Tenha todas as suas finanças centralizadas em um único lugar.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Economia de Tempo:</a> <a>Automatize tarefas financeiras e economize tempo no dia a dia.</a>
                                </li>
                                <li class="pt-1.5">
                                    <a class="font-semibold">Melhoria Financeira:</a> <a>Tome decisões informadas e melhore sua saúde financeira a cada dia.</a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <?php include('resources\views\components\footer.html') ?>
    <script type="text/javascript" src="../js/mode_switcher.js"></script>
</body>

</html>