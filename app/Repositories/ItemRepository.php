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
        return $this->model->find($id);
    }

    public function findTrashed($id)
    {
        return $this->model::onlyTrashed()->find($id);
    }
    public function store(array $data)
    {
        return $this->model->create($data);
    }

    public function update($data)
    {
        try{
            return $this->model->update($data);
        }catch (\Throwable $e){
            return redirect('errors.404');
        }
    }

    public function softDelete($id)
    {
       return  $this->findById($id)->delete();
    }

    public function restore($id)
    {
        return $this->model::withTrashed()->find($id)->restore();
    }

    public function delete($id)
    {
        return $this->findById($id)->forceDelete();

    }
    
    public function destroy($id)
    {
        return $this->findById($id)->forceDelete();
    }


}