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

     /**
     * Find specific Item and relation with Invoice with $id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findRelationWithInvoice(int $id)
    {
       return  $this->itemRepository->findRelationWithInvoice($id);
        
    }

     /**
     * Find specific Item with $id.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function findById(int $id) 
    {
        return $this->itemRepository->findById($id);
    }

      /**
     * Display a listing of the resource. 
     *
     */
    public function all()
    {
       return  $this->itemRepository->all();
    }

     /**
     * Store a newly created resource in storage.
     * @param \Request\ItemStoreRequest $request - array $data
     */
    public function store(array $data)
    {
        return  $this->itemRepository->store($data);
    }
    
     /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request - array $data
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data,$id)
    {
        return $this->itemRepository->update($data, $id);
    }

     /**
     * Restore the specified Item from Trashed Item.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function restore(int $id) 
    {
        return $this->itemRepository->restore($id);
    }

     /**
     * Remove the specified ttem from view, but exist in DB, and move to TrashedItem.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function softDelete(int $id)
    {
        return $this->itemRepository->softDelete($id);
    }

     /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(int $id)
    {
        return $this->itemRepository->delete($id);
    }

}