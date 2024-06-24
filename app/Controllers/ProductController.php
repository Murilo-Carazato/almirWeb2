<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Controllers\SessionController;
use App\Bll\ProductBll;
use App\Models\Product as ProductModel;

class ProductController
{
    private $productBll;
    private $sessionController;

    public function __construct()
    {
        $this->productBll = new ProductBll();
        $this->sessionController = new SessionController();
    }
    private function validateProductInput(ProductModel $product)
    {
        if (isset($_POST['description']) && !empty($_POST['description'])) {
            $product->setDescription($_POST['description']);
        }
        if (isset($_POST['unitPrice'])) {
            $product->setUnitPrice((float)$_POST['unitPrice']);
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
        $userId = $this->sessionController->getCurrentUserId();

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
        $userId = $this->sessionController->getCurrentUserId();
        $products = $this->productBll->Select();

        return $products;
    }

    public function show($id)
    {
        $this->sessionController->getCurrentUserId();
        return $this->productBll->SelectById($id);
    }

    public function update($id)
    {
        $product = new ProductModel();
        $product->setId($id);
        $this->validateProductInput($product);
        $userId = $this->sessionController->getCurrentUserId();

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
            header("Location: /resources/views/menu.php");
        } else {
            echo "Erro ao deletar produto";
        }
    }
}
