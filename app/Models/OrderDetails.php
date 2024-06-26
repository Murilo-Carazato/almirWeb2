<?php

namespace App\Models;

class OrderDetails
{
   private ?int $userId;
   private ?string $userName;
   private ?string $productDescription;
   private ?int $totalOrders;
   private ?float $totalAdminCosts;
   private ?float $totalClientCosts;

   public function __construct()
   {
   }

   public function getUserId()
   {
      return $this->userId;
   }

   public function setUserId(int $userId)
   {
      $this->userId = $userId;
   }

   public function getUserName()
   {
      return $this->userName;
   }

   public function setUserName(string $userName)
   {
      $this->userName = $userName;
   }

   public function getProductDescription()
   {
      return $this->productDescription;
   }

   public function setProductDescription(string $productDescription)
   {
      $this->productDescription = $productDescription;
   }

   public function getTotalOrders()
   {
      return $this->totalOrders;
   }

   public function setTotalOrders(int $totalOrders)
   {
      $this->totalOrders = $totalOrders;
   }

   public function getTotalAdminCosts()
   {
      return $this->totalAdminCosts;
   }

   public function setTotalAdminCosts(float $totalAdminCosts)
   {
      $this->totalAdminCosts = $totalAdminCosts;
   }

   public function getTotalClientCosts()
   {
      return $this->totalClientCosts;
   }

   public function setTotalClientCosts(float $totalClientCosts)
   {
      $this->totalClientCosts = $totalClientCosts;
   }
}
