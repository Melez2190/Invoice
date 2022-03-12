<?php 

namespace App\Repositories\Interfaces;

interface RepositoryInterface
{
    public function findByRelation();
    // public function all();
    public function findById(int $id);
    public function store(array $data);
    public function delete($id);

}
