<?php

namespace App\Repositories;

interface UserRepositoryInterface
{
   public function create(array $userData);

   public function update(int $id, array $userData);

   public function delete(int $id);

   public function find(int $id, array $with = [], array $params = []);

   public function all();
   
}




