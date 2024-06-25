<?php

namespace App\Models;

use DateTime;

class Order
{
   private ?int $id;
   private ?int $userId;
   private ?int $productId;
   private ?int $quantity;
   private ?float $totalPrice;
   private ?DateTime $date;
   
   public function __construct()
   {
   }

   public function getId()
   {
      return $this->id;
   }

   public function setId(int $id)
   {
      $this->id = $id;
   }

   public function getUserId()
   {
      return $this->userId;
   }

   public function setUserId(int $userId)
   {
      $this->userId = $userId;
   }

   public function getProductId()
   {
      return $this->productId;
   }

   public function setProductId(int $productId)
   {
      $this->productId = $productId;
   }

   public function getDate()
   {
      return $this->date;
   }

   public function setDate(DateTime $date)
   {
      $this->date = $date;
   }

   public function getQuantity()
   {
      return $this->quantity;
   }

   public function setQuantity(int $quantity)
   {
      $this->quantity = $quantity;
   }

   public function getTotalPrice()
   {
      return $this->totalPrice;
   }

   public function setTotalPrice(float $totalPrice)
   {
      $this->totalPrice = $totalPrice;
   }
}
