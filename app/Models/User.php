<?php

namespace App\Models;

class User
{
   private ?int $id;
   private ?string $nome;
   private ?string $senha;

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

   public function getNome()
   {
      return $this->nome;
   }

   public function setNome(string $nome)
   {
      $this->nome = $nome;
   }

   public function getSenha()
   {
      return $this->senha;
   }

   public function setSenha(string $senha)
   {
      $this->senha = $senha;
   }

}
