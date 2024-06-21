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

    private function validateSession()
    {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }

        if (isset($_SESSION['currentUser'])) {
            $user = unserialize($_SESSION['currentUser']);
            return $user->getId();
        } else {
            echo "Usuário não está logado.";
            exit;
        }
    }

    private function validateProductInput($product)
    {
        if (isset($_POST['description']) && !empty($_POST['description'])) {
            $product->setDescription($_POST['description']);
        }
        if (isset($_POST['unitPrice']) && is_numeric($_POST['unitPrice'])) {
            $product->setUnitPrice($_POST['unitPrice']);
        }
        if (isset($_POST['stock']) && is_numeric($_POST['stock'])) {
            $product->setStock($_POST['stock']);
        }
    }

    //CRUD

    public function create()
    {
        $product = new ProductModel();
        $this->validateProductInput($product);
        $userId = $this->validateSession();

        $product->setUserId($userId);
        $result = $this->productBll->insert($product);

        if ($result instanceof ProductModel) {
            header("Location: /resources/views/product/products.php");
        } else {
            echo "Erro ao criar produto";
        }
    }

    public function index()
    {
        $userId = $this->validateSession();
        $products = $this->productBll->Select();

        return [
            'userId' => $userId,
            'products' => $products
        ];
    }

    public function show($id)
    {
        $this->validateSession();
        return $this->productBll->SelectById($id);
    }

    public function update($id)
    {
        $product = new ProductModel();
        $product->setId($id);
        $this->validateProductInput($product);
        $userId = $this->validateSession();

        $product->setUserId($userId);
        $result = $this->productBll->Update($product);

        if ($result) {
            header("Location: /resources/views/product/products.php");
        } else {
            echo "Erro ao atualizar produto";
        }
    }

    public function destroy($id)
    {
        $result = $this->productBll->Delete($id);

        if ($result) {
            header("Location: /resources/views/product/products.php");
        } else {
            echo "Erro ao deletar produto";
        }
    }
}
