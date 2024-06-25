<?php

namespace App\Controllers;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Bll\ProductBll;
use App\Models\Product as ProductModel;
use App\Controllers\SessionController;

class ProductController
{
    private $productBll;
    private $sessionController;

    public function __construct()
    {
        $this->productBll = new ProductBll();
        $this->sessionController = new SessionController();
    }

    public function create()
    {
        $productData = $_POST;
        var_dump($productData);
        
        $userId = $this->sessionController->getCurrentUserId();
        $result = $this->productBll->createProduct($productData, $userId);


        if ($result instanceof ProductModel) {
            header("Location: /resources/views/menu.php");
        } else {
            echo "Erro ao criar produto";
        }
    }

    public function index()
    {
        $products = $this->productBll->getAllProducts();
        return $products;
    }

    public function show($id)
    {
        return $this->productBll->getProductById($id);
    }

    public function update($id)
    {
        
        $unitPrice = str_replace("R$", "", $_POST["unitPrice"]);
        $unitPrice = preg_replace("/[^\d.,]/", "", $unitPrice);
        $unitPrice = str_replace(",", ".", $unitPrice);

        $_POST["unitPrice"] = (float)$unitPrice; 
        
        $productData = $_POST;

        $userId = $this->sessionController->getCurrentUserId();
        $result = $this->productBll->updateProduct($id, $productData, $userId);

        if ($result) {
            header("Location: /resources/views/menu.php");
        } else {
            echo "Erro ao atualizar produto";
        }
    }

    public function destroy($id)
    {
        $result = $this->productBll->deleteProduct($id);

        if ($result) {
            header("Location: /resources/views/menu.php");
        } else {
            echo "Erro ao deletar produto";
        }
    }

}
