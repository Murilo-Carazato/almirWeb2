<?php

namespace App\Bll;

use App\Models\Product;
use App\Dal\ProductDal;

class ProductBll
{
    private $productDal;

    public function __construct()
    {
        $this->productDal = new ProductDal();
    }

    public function createProduct($productData, $userId)
    {
        $product = new Product();
        $this->validateProductInput($productData, $product);
        $product->setUserId($userId);

        return $this->productDal->insert($product);
    }

    public function getAllProducts()
    {
        return $this->productDal->select();
    }

    public function getProductById($id)
    {
        return $this->productDal->selectById($id);
    }

    public function updateProduct($id, $productData, $userId)
    {
        $product = new Product();
        $product->setId($id);
        $this->validateProductInput($productData, $product);
        $product->setUserId($userId);

        return $this->productDal->update($product);
    }

    public function deleteProduct($id)
    {
        return $this->productDal->delete($id);
    }

    private function validateProductInput($data, Product $product)
    {
        if (isset($data['description']) && !empty($data['description'])) {
            $product->setDescription($data['description']);
        }
        if (isset($data['unitPrice'])) {
            $product->setUnitPrice((float)$data['unitPrice']);
        }
        if (isset($data['stock']) && is_numeric($data['stock'])) {
            $product->setStock($data['stock']);
        }
    }
}
