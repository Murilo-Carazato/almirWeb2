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
}
