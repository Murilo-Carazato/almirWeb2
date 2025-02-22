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
    private $productDal;
    private $productBll;

    public function __construct()
    {
        $this->orderDal = new OrderDal();
        $this->productDal = new ProductDal();
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

    public function updateOrder($id, $orderData, $userId, $idDoProdutoAntigo)
    {
        // Busca o pedido pelo ID
        $order = $this->orderDal->selectById($id);

        $lastQuantity = $order->getQuantity();
        $this->validateOrderInput($orderData, $order);
        $newQuantity =  $order->getQuantity();

        // Busca o produto associado ao pedido
        $productId = $order->getProductId();
        $product = $this->productBll->getProductById($productId);

        // Atualiza o estoque dos produtos
        if ($idDoProdutoAntigo != null) {
            $this->updateProductStockOnExchange($order, $idDoProdutoAntigo);
        } else {
            $this->adjustProductStock($order, $lastQuantity, $newQuantity);
        }

        // Calcula o preço total do pedido com base na nova quantidade
        $order->setTotalPrice($order->getQuantity() * $product->getUnitPrice());

        // Atualiza o pedido no banco de dados
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

        //post
        if (is_object($data)) {
            if (!empty($data->quantity)) {
                $order->setQuantity($data->quantity);
            }
            if (!empty($data->id)) {
                $order->setProductId($data->id);
            }
            date_default_timezone_set('America/Sao_Paulo');
            $dateString = date("Y-m-d H:i:s");
            $date = new DateTime($dateString);
            $order->setDate($date);
        }

        // var_dump($data);
        // die();
        //update
        if (is_array($data)) {
            if (!empty($data["quantity"])) {
                $order->setQuantity($data["quantity"]);
            }
            if (!empty($data["productId"])) {
                $order->setProductId($data["productId"]);
            }
            if (!empty($data["date"])) {
                $date = new DateTime($data['date']);
                $order->setDate($date);
            } else {
                date_default_timezone_set('America/Sao_Paulo');
                $dateString = date("Y-m-d H:i:s");
                $date = new DateTime($dateString);
                $order->setDate($date);
            }
        }
    }

    private function updateProductStockOnExchange($order, $idDoProdutoAntigo)
    {
        // Atualiza o estoque do produto antigo
        $oldProduct = $this->productBll->getProductById($idDoProdutoAntigo);
        $oldProduct->setStock($oldProduct->getStock() + $order->getQuantity());

        // Atualiza o estoque do novo produto
        $newProductId = $order->getProductId();
        $newProduct = $this->productBll->getProductById($newProductId);
        $newProduct->setStock($newProduct->getStock() - $order->getQuantity());

        // Atualiza os produtos no banco de dados
        $this->productDal->update($oldProduct);
        $this->productDal->update($newProduct);
    }

    private function adjustProductStock($order, $lastQuantity, $newQuantity)
    {
        $productId = $order->getProductId();
        $product = $this->productBll->getProductById($productId);
        if (!$product) {
            throw new \Exception("Produto não encontrado.");
        }

        // Ajusta o estoque do produto com base na mudança de quantidade
        if ($lastQuantity > $newQuantity) {
            $product->setStock($product->getStock() + ($lastQuantity - $newQuantity));
        } else {
            $product->setStock($product->getStock() - ($newQuantity - $lastQuantity));
        }

        // Atualiza o produto no banco de dados
        $this->productDal->update($product);
    }
}
