<?php

namespace App\Dal;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Connection;
use App\Models\Product as ProductModel;
use PDO;

class ProductDal
{
    public function Select()
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM product;";
        $stmt = $pdo->query($sql);
        $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $products = [];

        foreach ($data as $line) {
            $product = new ProductModel();
            $product->setId($line['id']);
            $product->setDescription($line['description']);
            $product->setUnitPrice($line['unit_price']);
            $product->setStock($line['stock']);
            $product->setUserId($line['user_id']);
            $products[] = $product;
        }

        return $products;
    }

    public function SelectById(string $id)
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM product WHERE id = :id;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $product = new ProductModel();
        $product->setId($data['id']);
        $product->setDescription($data['description']);
        $product->setUnitPrice($data['unit_price']);
        $product->setStock($data['stock']);
        $product->setUserId($data['user_id']);

        return $product;
    }

    public function Update(ProductModel $product)
    {
        $sql = "UPDATE product SET description = ?, unit_price = ?, stock = ? WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($product->getDescription(), $product->getUnitPrice(), $product->getStock(), $product->getId()));
        Connection::disconnect();

        return $result;
    }

    public function insert(ProductModel $product)
    {
        $pdo = Connection::connect();
        $sql = "INSERT INTO product (description, unit_price, stock, user_id) VALUES (:description, :unit_price, :stock, :user_id)";
        $stmt = $pdo->prepare($sql);

        $description = $product->getDescription();
        $unitPrice = $product->getUnitPrice();
        $stock = $product->getStock();
        $userId = $product->getUserId();

        $stmt->bindParam(':description', $description);
        $stmt->bindParam(':unit_price', $unitPrice);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':user_id', $userId);
        $stmt->execute();

        Connection::disconnect();

        return $product;
    }

    public function Delete(int $id)
    {
        $sql = "delete from product WHERE id = ?;";

        $pdo = Connection::connect();
        $query = $pdo->prepare($sql);
        $result = $query->execute(array($id));
        Connection::disconnect();

        return $result;
    }

    public function SelectByDescription(string $description)
    {
        $pdo = Connection::connect();
        $sql = "SELECT * FROM product WHERE description = :description;";
        $stmt = $pdo->prepare($sql);
        $stmt->bindParam(':description', $description);
        $stmt->execute();
        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        Connection::disconnect();

        $product = new ProductModel();
        $product->setId($data['id']);
        $product->setDescription($data['description']);
        $product->setUnitPrice($data['unit_price']);
        $product->setStock($data['stock']);
        $product->setUserId($data['user_id']);

        return $product;
    }
}
