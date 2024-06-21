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
            $products[] = $product;
        }

        return $products;
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
        $stmt->bindParam(':unitPrice', $unitPrice);
        $stmt->bindParam(':stock', $stock);
        $stmt->bindParam(':userId', $userId);
        $stmt->execute();

        Connection::disconnect();

        return $product;
    }
}
