<?php

namespace App\Bll;

use App\Dal\ProductDal;
use App\Models\Product as ProductModel;

class ProductBll
{
    public function Select()
    {
        $dalProduct = new ProductDal();

        return $dalProduct->Select();
    }

    public function SelectById(int $id)
    {
        $dalProduct = new ProductDal();

        return $dalProduct->SelectById($id);
    }

    public function Update(ProductModel $product)
    {
        $dalProduct = new ProductDal();

        return $dalProduct->Update($product);
    }

    public function Insert(ProductModel $product)
    {
        $dalProduct = new ProductDal();

        return $dalProduct->Insert($product);
    }


}
