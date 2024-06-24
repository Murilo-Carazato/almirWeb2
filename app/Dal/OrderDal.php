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
        $order->setDate($data['date']);
        $order->setUserId($data['user_id']);

        return $order;
    }

    public function Update(OrderModel $order)
    {
        $sql = "UPDATE almirweb.order SET date = ?, user_id = ? WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($order->getDate(), $order->getUserId(), $order->getId()));
        Connection::disconnect();

        return $result;
    }

    public function insert(OrderModel $order)
    {
        $pdo = Connection::connect();
        $sql = "INSERT INTO almirweb.order (date, user_id) VALUES (:date, :user_id)";
        $stmt = $pdo->prepare($sql);

        $date = $order->getDate()->format('Y-m-d');
        $userId = $order->getUserId();

        $stmt->bindParam(':date', $date);
        $stmt->bindParam(':user_id', $userId);

        var_dump($date);
        var_dump($stmt);
        var_dump($userId);
        die();
        $stmt->execute();

        Connection::disconnect();

        return $order;
    }

    public function Delete(int $id)
    {
        $sql = "delete from order WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($id));
        Connection::disconnect();

        return $result;
    }
}
