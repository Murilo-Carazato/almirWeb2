<?php

namespace App\Bll;

use App\Dal\OrderDal;
use App\Models\Order as OrderModel;

class OrderBll
{
    public function Select()
    {
        $dalOrder = new OrderDal();

        return $dalOrder->Select();
    }

    public function SelectById(int $id)
    {
        $dalOrder = new OrderDal();

        return $dalOrder->SelectById($id);
    }

    public function Update(OrderModel $order)
    {
        $dalOrder = new OrderDal();

        return $dalOrder->Update($order);
    }

    public function Insert(OrderModel $order)
    {
        $dalOrder = new OrderDal();

        return $dalOrder->Insert($order);
    }

    public function Delete(int $id)
    {
        $dalOrder = new OrderDal();

        return $dalOrder->Delete($id);
    }
}
