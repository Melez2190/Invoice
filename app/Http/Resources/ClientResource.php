<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ClientResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id'          => $this->id                ,
            'user_id'        => $this->user->id        ,
            'name'       => $this->name             ,
            'city'        => $this->city            ,
            'address'      => $this->adress            ,
            'account_number'    => $this->account_number    ,
            'id_number'         => $this->id_number        ,
            'tax_number'        => $this->tax_number           ,
            'zip_code'          => $this->zip_code         ,
            'email'             => $this->email            ,
            'phone_number'      => $this->phone_number       ,
            'created_by'        => $this->created_by      ,
            'updated_by'        => $this->updated_by      ,
            'created_by'        => $this->created_by      ,
            'created_at'  => $this->created_at->format('d-m-Y H:i') ,
            'updated_at'  => $this->updated_at->format('d-m-Y H:i') ,
            // 'deleted_at'  =>    
        ];
    }
}