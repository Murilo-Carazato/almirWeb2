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

    private function validateOrderInput(OrderModel $order)
    {
        if (isset($_POST['date']) && !empty($_POST['date'])) {
            $dateString = $_POST['date'];
            $date = new DateTime($dateString);
            $order->setDate($date);
        } else {
            date_default_timezone_set('America/Sao_Paulo');
            $dateString = date("Y-m-d H:i:s");
            $date = new DateTime($dateString);
            $order->setDate($date);
        }

        if (isset($_POST['quantity']) && !empty($_POST['quantity'])) {
            $quantity = $_POST['quantity'];
            $order->setQuantity($quantity);
        }

        if (isset($_POST['productId']) && !empty($_POST['productId'])) {
            $productId = $_POST['productId'];
            $order->setProductId($productId);
        }

    }

    //CRUD
    public function create()
    {
        $order = new OrderModel();
        $this->validateOrderInput($order);
        $userId = $this->sessionController->getCurrentUserId();
        $order->setUserId($userId);

        $productId = $order->getProductId();
        $productBll = new ProductBll();
        $product = $productBll->SelectById($productId);
        
        $order->setTotalPrice( $order->getQuantity() * $product->getUnitPrice());
        
        $result = $this->orderBll->insert($order);

        $product->setStock( $product->getStock() - $order->getQuantity());

        $productBll->update($product);

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
