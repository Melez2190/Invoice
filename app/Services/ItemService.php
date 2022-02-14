<?php

namespace App\Services;

use App\Repositories\ItemRepository;


class ItemService
{
    protected $itemRepository;

    public function __construct(ItemRepository $itemRepository)
    {
        $this->itemRepository = $itemRepository;
    }

    public function findRelationWithInvoice($id)
    {
       return  $this->itemRepository->findRelationWithInvoice($id);
        
    }

    public function findById(int $id) 
    {
        return $this->itemRepository->findById($id);
    }

    public function all()
    {
       return  $this->itemRepository->all();
    }

    public function store(array $data)
    {
        return  $this->itemRepository->store($data);
    }
    
    public function update($data, $id)
    {
        return $this->itemRepository->update($data, $id);
    }

    public function restore($id) 
    {
        return $this->itemRepository->restore($id);
    }
    public function softDelete($id)
    {
        return $this->itemRepository->softDelete($id);
    }
    public function delete($id)
    {
        return $this->itemRepository->delete($id);
    }

}