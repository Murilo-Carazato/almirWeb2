<?php

namespace App\Dal;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Database\Connection;
use App\Models\Product as ProductModel;
use PDO;
use PDOException;

class ProductDal
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
            $sql = "SELECT * FROM product;";
            $stmt = $this->pdo->query($sql);
            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);

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
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function SelectById(string $id)
    {
        try {
            $sql = "SELECT * FROM product WHERE id = :id;";
            $stmt = $this->pdo->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $data = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($data) {
                $product = new ProductModel();
                $product->setId($data['id']);
                $product->setDescription($data['description']);
                $product->setUnitPrice($data['unit_price']);
                $product->setStock($data['stock']);
                $product->setUserId($data['user_id']);
                return $product;
            } else {
                throw new \Exception("Product not found");
            }
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Update(ProductModel $product)
    {
        try {
            $sql = "UPDATE product SET description = ?, unit_price = ?, stock = ? WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([$product->getDescription(), $product->getUnitPrice(), $product->getStock(), $product->getId()]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function insert(ProductModel $product)
    {
        try {
            $sql = "INSERT INTO product (description, unit_price, stock, user_id) VALUES (:description, :unit_price, :stock, :user_id)";
            $stmt = $this->pdo->prepare($sql);

            $stmt->bindParam(':description', $product->getDescription());
            $stmt->bindParam(':unit_price', $product->getUnitPrice());
            $stmt->bindParam(':stock', $product->getStock());
            $stmt->bindParam(':user_id', $product->getUserId());
            $stmt->execute();

            return $product;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function Delete(int $id)
    {
        try {
            $sql = "DELETE FROM product WHERE id = ?;";
            $query = $this->pdo->prepare($sql);
            $result = $query->execute([$id]);

            return $result;
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }

    public function SelectByDescription(string $description)
    {
        try {
            $sql = "SELECT * FROM product WHERE description LIKE :description";
            $stmt = $this->pdo->prepare($sql);

            $descriptionLike = '%' . $description . '%';
            $stmt->bindParam(':description', $descriptionLike, PDO::PARAM_STR);

            $stmt->execute();

            $data = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
        } catch (PDOException $e) {
            throw new \Exception("Database query error: " . $e->getMessage());
        }
    }
}
