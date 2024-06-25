<?php

namespace App\Bll;

use App\Models\Order;
use App\Dal\OrderDal;
use App\Bll\ProductBll;
use DateTime;

class OrderBll
{
    private $orderDal;
    private $productBll;

    public function __construct()
    {
        $this->orderDal = new OrderDal();
        $this->productBll = new ProductBll();
    }

    public function createOrder($orderData, $userId)
    {
        $order = new Order();
        $this->validateOrderInput($orderData, $order);
        $order->setUserId($userId);

        $productId = $order->getProductId();
        $product = $this->productBll->getProductById($productId);

        $order->setTotalPrice($order->getQuantity() * $product->getUnitPrice());

        $result = $this->orderDal->insert($order);

        if ($result) {
            $product->setStock($product->getStock() - $order->getQuantity());
            $this->productBll->updateProduct($productId, $product, $userId);
        }

        return $result;
    }

    public function getAllOrders()
    {
        return $this->orderDal->select();
    }

    public function getOrderById($id)
    {
        return $this->orderDal->selectById($id);
    }

    public function updateOrder($id, $orderData, $userId)
    {
        $order = new Order();
        $order->setId($id);
        $this->validateOrderInput($orderData, $order);
        $order->setUserId($userId);

        return $this->orderDal->update($order);
    }

    public function deleteOrder($id)
    {
        return $this->orderDal->delete($id);
    }

    private function validateOrderInput($data, Order $order)
    {
        if (isset($data['date']) && !empty($data['date'])) {
            $date = new DateTime($data['date']);
            $order->setDate($date);
        } else {
            $date = new DateTime();
            $order->setDate($date);
        }

        if (isset($data['quantity']) && !empty($data['quantity'])) {
            $order->setQuantity($data['quantity']);
        }

        if (isset($data['productId']) && !empty($data['productId'])) {
            $order->setProductId($data['productId']);
        }
    }
}
