<?php

namespace App\Models;

class User
{
   private ?int $id;
   private ?string $name;
   private ?string $password;

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

   public function getName()
   {
      return $this->name;
   }

   public function setName(string $name)
   {
      $this->name = $name;
   }

   public function getPassword()
   {
      return $this->password;
   }

   public function setPassword(string $password)
   {
      $this->password = $password;
   }

}
