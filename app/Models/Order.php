<?php

namespace App\Models;

use DateTime;

class Order
{
   private ?int $id;
   private ?DateTime $date;
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

   public function getDate()
   {
      return $this->date;
   }

   public function setDate(DateTime $date)
   {
      $this->date = $date;
   }

   public function getUserId()
   {
      return $this->userId;
   }

   public function setUserId(int $userId)
   {
      $this->userId = $userId;
   }
}
