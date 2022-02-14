<?php 

namespace App\Repositories\Interfaces;

interface ItemRepositoryInterface
{
    public function findRelationWithInvoice($id);
    public function update($data, $id);
    public function softDelete($id);
    public function findTrashed($id);
    public function restore($id);
}