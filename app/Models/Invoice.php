<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'date_of_issue', 'valuta', ];
    
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
   
    public function userOwner(){
        return $this->hasOneThrough(
            User::class,
            Client::class,
           
        );
    }

    public function items() {
        return $this->hasMany(Item::class);
    }

    public function total() {
        $items = $this->items;
        $total = 0;
        foreach($items as $item){
            $total += ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv;
            

        }
        return $total;
    }

}
