<?php

namespace App\Dal;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Connection;
use App\Models\Order as OrderModel;
use DateTime;
use PDO;

class OrderDal
{
    public function Select()
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM almirweb.order;";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $orders = [];

        foreach ($data as $line) {
            $order = new OrderModel();
            $order->setId($line['id']);

            $date = new DateTime($line['date']);
            $order->setDate($date);

            $order->setQuantity($line['quantity']);
            $order->setTotalPrice($line['total_price']);
            $order->setProductId($line['product_id']);
            $order->setUserId($line['user_id']);
            $orders[] = $order;
        }

        return $orders;
    }

    public function SelectById(string $id)
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM almirweb.order WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $order = new OrderModel();
        $order->setId($data['id']);

        $date = new DateTime($data['date']);
        $order->setDate($date);

        $order->setQuantity($data['quantity']);
        $order->setTotalPrice($data['total_price']);
        $order->setUserId($data['user_id']);
        $order->setProductId($data['product_id']);

        return $order;
    }

    public function Update(OrderModel $order)
    {
        $sql = "UPDATE almirweb.order SET date = ?, product_id = ?, quantity = ? WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);

        $result = $query->execute(array($order->getDate()->format('Y-m-d H:i:s'), $order->getProductId(), $order->getQuantity() ,$order->getId()));
        Connection::disconnect();

        return $result;
    }

    public function insert(OrderModel $order)
    {
        $pdo = Connection::connect();
        $sql = "INSERT INTO almirweb.order (product_id, user_id, quantity, total_price, date) VALUES (:product_id, :user_id, :quantity, :total_price, :date);";

        $stmt = $pdo->prepare($sql);

        $userId = $order->getUserId();
        $productId = $order->getProductId();
        $quantity = $order->getQuantity();
        $totalPrice = $order->getTotalPrice();
        $date = $order->getDate()->format('Y-m-d H:i:s');

        $stmt->bindParam(':product_id', $productId);
        $stmt->bindParam(':user_id', $userId);
        $stmt->bindParam(':quantity', $quantity);
        $stmt->bindParam(':total_price', $totalPrice);
        $stmt->bindParam(':date', $date);

        $stmt->execute();

        Connection::disconnect();

        return $order;
    }

    public function Delete(int $id)
    {
        $sql = "DELETE FROM almirweb.order WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($id));
        Connection::disconnect();

        return $result;
    }
}
