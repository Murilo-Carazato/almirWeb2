<?php

namespace App\Dal;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Connection;
use App\Models\Order as OrderModel;
use App\Models\OrderDetails;
use DateTime;
use PDO;
use PDOException;

class OrderDal
{
    private $pdo;

    public function __construct()
    {
        $this->pdo = Connection::connect();
        $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    }

    public function __destruct()
    {
        Connection::disconnect();
    }

    public function Select()
    {
        try {
            $sql = "SELECT * FROM almirweb.order;";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $orders = [];
            foreach ($data as $line) {
                $order = new OrderModel();
                $order->setId($line['id']);
                $order->setDate(new DateTime($line['date']));
                $order->setQuantity($line['quantity']);
                $order->setTotalPrice($line['total_price']);
                $order->setProductId($line['product_id']);
                $order->setUserId($line['user_id']);
                $orders[] = $order;
            }

            return $orders;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function SelectById(string $id)
    {
        try {
            $sql = "SELECT * FROM almirweb.order WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $order = new OrderModel();
                $order->setId($data['id']);
                $order->setDate(new DateTime($data['date']));
                $order->setQuantity($data['quantity']);
                $order->setTotalPrice($data['total_price']);
                $order->setUserId($data['user_id']);
                $order->setProductId($data['product_id']);
                return $order;
            } else {
                throw new \Exception("Order not found");
            }
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Update(OrderModel $order)
    {
        try {
            $sql = "UPDATE almirweb.order SET date = ?, product_id = ?, quantity = ?, total_price = ? WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([
                $order->getDate()->format('Y-m-d H:i:s'), 
                $order->getProductId(), 
                $order->getQuantity(), 
                $order->getTotalPrice(), 
                $order->getId()
            ]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function insert(OrderModel $order)
    {
        try {
            $sql = "INSERT INTO almirweb.order (product_id, user_id, quantity, total_price, date) VALUES (:product_id, :user_id, :quantity, :total_price, :date);";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':product_id', $order->getProductId());
            $stmt->bindParam(':user_id', $order->getUserId());
            $stmt->bindParam(':quantity', $order->getQuantity());
            $stmt->bindParam(':total_price', $order->getTotalPrice());
            $stmt->bindParam(':date', $order->getDate()->format('Y-m-d H:i:s'));

            $stmt->execute();

            return $order;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Delete(int $id)
    {
        try {
            $sql = "DELETE FROM almirweb.order WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([$id]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function ShowOrderDetails()
    {
        try {
            $sql = "SELECT 
                u.id AS user_id,
                u.name AS user_name,
                p.description AS product_description,
                COUNT(o.id) AS total_orders,
                SUM(CASE WHEN u.type = 'admin' THEN o.total_price ELSE 0 END) AS total_admin_costs,
                SUM(CASE WHEN u.type = 'client' THEN o.total_price ELSE 0 END) AS total_client_costs
            FROM 
                almirweb.order o
            JOIN 
                almirweb.user u ON o.user_id = u.id
            JOIN 
                almirweb.product p ON o.product_id = p.id
            GROUP BY 
                u.id, u.name, p.description;";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

            $details = [];
            foreach ($data as $line) {
                $orderDetail = new OrderDetails();
                $orderDetail->setUserId($line['user_id']);
                $orderDetail->setProductId($line['product_id']);
                $orderDetail->setUserName($line['user_name']);
                $orderDetail->setProductDescription($line['product_description']);
                $orderDetail->setTotalOrders($line['total_orders']);
                $orderDetail->setTotalAdminCosts($line['total_admin_costs']);
                $orderDetail->setTotalClientCosts($line['total_client_costs']);
                $details[] = $orderDetail;
            }

            return $details;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }
}
