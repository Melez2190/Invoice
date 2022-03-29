<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Models\User;
use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Item extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $table = 'items';
    protected $primaryKey = 'id';
    protected $fillable = ['invoice_id', 'description', 'quantity', 'price', 'pdv', 'created_by', 'updated_by', 'user_id'];
    protected $dates = ['deleted_at'];



     /**
    * The "booting" method of the model.
    *
    * @return void
    */
    protected static function boot()
    {
        parent::boot();

        static::addGlobalScope(new TenantScope);
    }

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
