<?php

namespace App\Observers;

// use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\item;
use App\Models\Invoice;



class ModelObserver 
{
  

    public function creating($model) 
    { 
        if(auth()->user()){
            $model->created_by = auth()->user()->id;
            $model->updated_by = auth()->user()->id;
         }
    }

   public function created($model)
    {
        // 
      
    }

   
   
    public function updating($model)
     {
         
         $model->updated_by = auth()->user()->id;
     }

    public function updated($model)
    {
        //   
    }

    /**
     * Handle the item "deleted" event.
     *
     * @param  \App\Models\item  $item
     * @return void
     */
    public function deleting($model)
    {
        $model->deleted_by = auth()->user()->id;
    }
    public function deleted($model)
    {
        $model->deleted_by = auth()->user()->id;
     
    }

    /**
     * Handle the item "restored" event.
     *
     * @param  \App\Models\item  $item
     * @return void
     */
    public function restore($model, $id)
    {
    
    }
    public function restored($model)
    {
      
    }

    /**
     * Handle the item "force deleted" event.
     *
     * @param  \App\Models\item  $item
     * @return void
     */
    public function forceDeleted($model)
    {
        //
    }
}
