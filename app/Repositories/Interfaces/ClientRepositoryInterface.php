<?php 

namespace App\Repositories\Interfaces;

interface ClientRepositoryInterface
{
    public function update($data, $id);

    public function all($attributes);

   
}