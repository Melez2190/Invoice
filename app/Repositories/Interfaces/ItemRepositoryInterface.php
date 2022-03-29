<?php 

namespace App\Repositories\Interfaces;

interface ItemRepositoryInterface
{
    public function findRelationWithInvoice($id);
    public function update($data);
    public function softDelete($id);
    public function destroy($id);
    public function findTrashed($id);
    public function restore($id);
}