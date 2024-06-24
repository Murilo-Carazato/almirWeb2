<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\SessionController;
use App\Bll\OrderBll;
use App\Models\Order as OrderModel;
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

    private function validateOrderInput(OrderModel $order)
    {
        if (isset($_POST['date']) && !empty($_POST['date'])) {
            $dateString = $_POST['date'];
            $date = new DateTime($dateString);
            $order->setDate($date);
        }
    }

    //CRUD
    public function create()
    {
        $order = new OrderModel();
        $this->validateOrderInput($order);
        $userId = $this->sessionController->getCurrentUserId();
        $order->setUserId($userId);
        $result = $this->orderBll->insert($order);

        if ($result instanceof OrderModel) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao criar produto";
        }
    }

    public function index()
    {
        $userId = $this->sessionController->getCurrentUserId();
        $orders = $this->orderBll->Select();

        return $orders;
    }

    public function show($id)
    {
        $this->sessionController->getCurrentUserId();
        return $this->orderBll->SelectById($id);
    }

    public function update($id)
    {
        $order = new OrderModel();
        $order->setId($id);
        $this->validateOrderInput($order);
        $userId = $this->sessionController->getCurrentUserId();

        $order->setUserId($userId);
        $result = $this->orderBll->Update($order);

        if ($result) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao atualizar produto";
        }
    }

    public function destroy($id)
    {
        $result = $this->orderBll->Delete($id);

        if ($result) {
            header("Location: /resources/views/order/orders.php");
        } else {
            echo "Erro ao deletar produto";
        }
    }
}
