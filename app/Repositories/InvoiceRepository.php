<?php

namespace App\Repositories;

use App\Events\InvoiceCreated;
use App\Models\Invoice;
use App\Models\Client;
use App\Repositories\Interfaces\InvoiceRepositoryInterface;
use App\Repositories\Interfaces\RepositoryInterface;
use Illuminate\Database\Eloquent\ModelNotFoundException;


class InvoiceRepository implements RepositoryInterface, InvoiceRepositoryInterface
{

    
     /**
    * @var Invoice $model
    */

    private $model;

    public function __construct(Invoice $model)
    {
        $this->model = $model;
    }
    
    public function findByRelation()
    {
        return $this->model::whereRelation('client', 'user_id', '=', auth()->user()->id);
    }
    
    public function all()
    {
        return $this->findByRelation()->filter(request([
            'client_name',
            'date_of_issue',
            'to_date_of_issue',
            'valuta',
            'tovaluta',
            'status_true',
            'status'
        ]))->paginate(10);
    }

    public function findById(int $id)
    {
        if($this->model->find($id)){
            return $this->model->find($id);
        }else {
            return abort(404);
        }
    }
    public function store(array $data)
    {
        $invoice =  $this->model->create($data);
        return $invoice;
    }
    public function updatestatus($request, $id)
    { 
        if(isset($_POST['btn-status'])){
          return $this->model::where('id', $id)->update([
                'status' => request()->input('status')
            ]);
        }
    }

    public function updaterest($request, $id)
    {
        if(isset($_POST['btn-ostalo'])){
            return $this->model::where('id', $id)->update([ 
                'date_of_issue' => request()->input('date_of_issue'),
                'valuta' => request()->input('valuta')
            ]);
        }
    }

    public function delete($id)
    {
        $this->findById($id)->delete();
    }
}