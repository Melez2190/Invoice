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

    // public static function totalSum($items){
    //     dd($items->price);
    //      return   ($items['quantity'] * 'price')+(($items->quantity * $items->price)/100)*$items->pdv;
        
    // }
}
