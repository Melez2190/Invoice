<?php 

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{
    public function update($data);

    public function all($attributes);

   
}