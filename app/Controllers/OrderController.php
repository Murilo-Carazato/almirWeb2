<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\SessionController;
use App\Bll\OrderBll;
use App\Bll\ProductBll;
use App\Models\Order as OrderModel;
use App\Models\Product;
use DateTime;

class OrderController
{
    private $orderBll;
    private $sessionController;

    public function __construct()
    {
        $this->orderBll = new OrderBll();
        $this->sessionController = new SessionController();
    }


    public function create()
    {
        $orderData = $_POST;
        // var_dump($orderData);

        $userId = $this->sessionController->getCurrentUserId();
        $result = $this->orderBll->createOrder($orderData, $userId);

        if ($result instanceof OrderModel) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao criar pedido";
        }
    }

    public function index()
    {
        // $userId = $this->sessionController->getCurrentUserId();
        $orders = $this->orderBll->getAllOrders();
        return $orders;
    }

    public function show($id)
    {
        return $this->orderBll->getOrderById($id);
    }

    public function update($id)
    {
        $orderData = $_POST;
        $userId = $this->sessionController->getCurrentUserId();
        $result = $this->orderBll->updateOrder($id, $orderData, $userId);

        if ($result) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao atualizar pedido";
        }
    }

    public function destroy($id)
    {
        $result = $this->orderBll->deleteOrder($id);

        if ($result) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao deletar pedido";
        }
    }
}
