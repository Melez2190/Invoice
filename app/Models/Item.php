<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;
    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ['invoice_id', 'description', 'quantity', 'price', 'pdv'];

    public function invoices() {
        return $this->belongsTo(Invoice::class, 'invoice_id');
    }

    public function itemtotal(){
        $items = $this->items;
        
        foreach($items as $item){
            return ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv;
        }
    }

  
}
