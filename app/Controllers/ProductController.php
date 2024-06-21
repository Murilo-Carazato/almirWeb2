<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\ProductBll;
use App\Models\Product as ProductModel;

class ProductController
{
    private $productBll;

    public function __construct()
    {
        $this->productBll = new ProductBll();
    }

    public function listProducts()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            $userId = $user->getId();
        } else {
            echo "Usuário não está logado.";
            return;
        }

        $bllProduct = new ProductBll();
        $products = $bllProduct->Select();

        return [
            'userId' => $userId,
            'products' => $products
        ];
    }

    public function getProductDetails($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $bllProduct = new ProductBll();
        $product = $bllProduct->SelectById($id);

        return $product;
    }

    public function getProductForEdit($id)
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        $bllProduct = new ProductBll();
        $product = $bllProduct->SelectById($id);

        return $product;
    }

    public function addProduct()
    {
        $product = new ProductModel;

        if (isset($_POST['description']) && !is_null($_POST['description'])) {
            $product->setDescription($_POST['description']);
        }
        if (isset($_POST['unitPrice']) && !is_null($_POST['unitPrice'])) {
            $product->setUnitPrice($_POST['unitPrice']);
        }
        if (isset($_POST['stock']) && !is_null($_POST['stock'])) {
            $product->setStock($_POST['stock']);
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }


        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            $userId = $user->getId();
        } else {
            echo "Usuário não está logado.";
        }

        $product->setUserId($userId);

        $result = $this->productBll->insert($product);

        if ($result instanceof ProductModel) {
            header("location: /resources/views/product/products.php");
        } else {
            echo "Erro ao criar produto";
        }
    }

    public function editProduct($id)
    {

        $product = new ProductModel;

        $product->setId($id);

        if (isset($_POST['description']) && !is_null($_POST['description'])) {
            $product->setDescription($_POST['description']);
        }
        if (isset($_POST['unitPrice']) && !is_null($_POST['unitPrice'])) {
            $product->setUnitPrice($_POST['unitPrice']);
        }
        if (isset($_POST['stock']) && !is_null($_POST['stock'])) {
            $product->setStock($_POST['stock']);
        }

        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            $userId = $user->getId();
        } else {
            echo "Usuário não está logado.";
        }

        $product->setUserId($userId);

        $result = $this->productBll->Update($product);

        if ($result == true) {
            header("location: /resources/views/product/products.php");
        } else {
            echo "Erro ao atualizar produto";
        }
    }

    public function deleteProduct($id)
    {
        $result = $this->productBll->Delete($id);

        if ($result == true) {
            header("location: /resources/views/product/products.php");
        } else {
            echo "Erro ao atualizar produto";
        }
    }
}
