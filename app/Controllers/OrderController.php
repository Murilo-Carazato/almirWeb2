<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\SessionController;
use App\Bll\OrderBll;
use App\Models\Order as OrderModel;

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
        $orderData = json_decode($_POST['cart']);
        $userId = $this->sessionController->getCurrentUserId();
        $results = [];
        $status = false;
        foreach ($orderData as $val) {
            $results[] = $this->orderBll->createOrder($val, $userId);
        }
        foreach ($results as $result) {
            if ($result instanceof OrderModel) {
                $status = false;
            } else {
                $status = true;
                break;
            }
        }
        if ($status) {
            echo "Erro ao criar pedido";
        } else {
            header("Location: /resources/views/order/my_orders.php");
            exit();
        }
    }

    public function index()
    {
        $orders = $this->orderBll->getAllOrders();
        return $orders;
    }

    public function show($id)
    {
        return $this->orderBll->getOrderById($id);
    }

    public function update($id, $idDoProdutoAntigo)
    {
        $orderData = $_POST;
        $userId = $this->sessionController->getCurrentUserId();
        
        $result = $this->orderBll->updateOrder($id, $orderData, $userId, $idDoProdutoAntigo);

        if ($result) {
            header("Location: /resources/views/order/my_orders.php");
            exit();
        } else {
            echo "Erro ao atualizar pedido";
        }
    }

    public function destroy($id)
    {
        $result = $this->orderBll->deleteOrder($id);

        if ($result) {
            header("Location: /resources/views/order/my_orders.php");
        } else {
            echo "Erro ao deletar pedido";
        }
    }
}
