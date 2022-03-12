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
    

    
     /**
     * Find invoice by relations. 
     *
     */
    public function findByRelation()
    {
        return $this->model::whereRelation('client', 'user_id', '=', auth()->user()->id);
    }
    

     /**
     * Display a listing of the resource. 
     *
     * @param  array  $attributes - [start, length, search]
     * @return \Illuminate\Http\Response
     */
    public function all($attributes)
    {  

        if($attributes['search']['value'] != NULL){
            return $this->model->with('client')->get();
         
              
        }

        return $this->model->skip($attributes['start'])->take($attributes['length'])->with('client')->get();
    }

     /**
     * Find invoice by id. 
     * * @param  int  $id 
     *
     */
    public function findById(int $id)
    {
        if($this->model->find($id)){
            return $this->model->find($id);
        }else {
            return abort(404);
        }
    }

    /**
     * Store a new invoice in DB 
     *
     * @param  array  $data
     */
    public function store(array $data)
    {
        $invoice =  $this->model->create($data);

        return $invoice;
    }

    /**
     * changing payment status
     *
     * @param  int  $request - [0, 1]
     * @param  int  $id 
     * @return \Illuminate\Http\Response
     */
    public function updatestatus($request, $id)
    { 
        $invoice = $this->findById($id);
        $invoice->status = $request;
        $invoice->save();

        return $invoice;
    }

      /**
     * Update the specified resource in storage.
     *
     * @param  $data 
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update($data, $id)
    {
        return $this->model::where('id', $id)->update([
            'date_of_issue' => $data->date_of_issue,
            'valuta'        => $data->valuta,
            'updated_by'    => auth()->user()->id
        ]);
        
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete($id)
    {
        $this->findById($id)->forceDelete();
    }
}