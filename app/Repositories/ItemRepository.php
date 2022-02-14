<?php

namespace App\Repositories;

use App\Models\Item;
use App\Repositories\Interfaces\ItemRepositoryInterface;
// use App\Repositories\Interfaces\ItemRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class ItemRepository implements RepositoryInterface, ItemRepositoryInterface
{

    
     /**
    * @var Item $model
    */

    private $model;

    public function __construct(Item $model)
    {
        $this->model = $model;
    }
    public function findRelationWithInvoice($id)
    {
        
        $invoice =  $this->model::where('id', '=', $id)->first()->invoice_id;
        return $invoice;
    }

    public function findByRelation()
    {
        return $this->model::whereRelation('invoice_id', '=', 'id')->get();
    }

    public function all()
    {
        return $this->findByRelation()->all();
    }

    public function findById($id)
    {
      

        try {
             return $this->model->findOrFail($id);
        } catch (ModelNotFoundException $e) {
            return "greska";
        }
    }
    public function findTrashed($id)
    {
        return $this->model::onlyTrashed()->find($id);
    }
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($data, $id)
    {
      return $this->findById($id)->update($data);    

    }

    public function softDelete($id)
    {
       return  $this->findById($id)->delete();
    }

    public function delete($id)
    {
        return $this->findTrashed($id)->forceDelete();
    }


}