<?php

namespace App\Bll;

use App\Models\Order;
use App\Dal\OrderDal;
use App\Dal\ProductDal;
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
        if (!$product) {
            throw new \Exception("Produto não encontrado.");
        }

        $order->setTotalPrice($order->getQuantity() * $product->getUnitPrice());

        $result = $this->orderDal->insert($order);

        if ($result instanceof Order) {
            $productDal = new ProductDal(); //usar dal ou bll? bll tem somente o método de update específico para o formulário
            $product->setStock($product->getStock() - $order->getQuantity());
            $productDal->update($product);
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
        $order = $this->orderDal->selectById($id);
        if (!$order) {
            throw new \Exception("Pedido não encontrado.");
        }

        $lastQuantity = $order->getQuantity();
        $this->validateOrderInput($orderData, $order);
        $newQuantity =  $order->getQuantity();

        $productId = $order->getProductId();
        $product = $this->productBll->getProductById($productId);
        if (!$product) {
            throw new \Exception("Produto não encontrado.");
        }

        if ($lastQuantity > $newQuantity) {
            $product->setStock($product->getStock() + ($lastQuantity - $newQuantity));
        } else {
            $product->setStock($product->getStock() - ($newQuantity - $lastQuantity));
        }

        $order->setTotalPrice($newQuantity * $product->getUnitPrice());

        $productDal = new ProductDal();
        $productDal->update($product);//acho q é melhor usar o bll

        $order->setUserId($userId);

        $result = $this->orderDal->update($order);

        return $result;
    }

    public function deleteOrder($id)
    {
        $order = $this->orderDal->selectById($id);
        if (!$order) {
            throw new \Exception("Pedido não encontrado.");
        }

        $productId = $order->getProductId();
        $product = $this->productBll->getProductById($productId);
        if (!$product) {
            throw new \Exception("Produto não encontrado.");
        }

        $product->setStock($product->getStock() + $order->getQuantity());
        $productDal = new ProductDal();
        $productDal->update($product);

        return $this->orderDal->delete($id);
    }

    private function validateOrderInput($data, Order $order)
    {
        //Acessa objeto vindo do $_POST e valida atributo quantity
        if (!empty($data->quantity)) {
            $order->setQuantity($data->quantity);
        }
        //Acessa objeto vindo do $_POST e valida atributo id (id do PRODUTO, e não do pedido)
        if (!empty($data->id)) {
            $order->setProductId($data->id);
        }

        date_default_timezone_set('America/Sao_Paulo');
        $dateString = date("Y-m-d H:i:s");
        $date = new DateTime($dateString);
        $order->setDate($date);
    }
}
