<?php

namespace App\Models;

class Product
{
   private ?int $id;
   private ?string $description;
   private ?float $unitPrice;
   private ?int $stock;
   private ?int $userId;

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

   public function getDescription()
   {
      return $this->description;
   }

   public function setDescription(string $description)
   {
      $this->description = $description;
   }

   public function getUnitPrice()
   {
      return $this->unitPrice;
   }

   public function setUnitPrice(float $unitPrice)
   {
      $this->unitPrice = $unitPrice;
   }

   public function getStock()
   {
      return $this->stock;
   }

   public function setStock(int $stock)
   {
      $this->stock = $stock;
   }

}
