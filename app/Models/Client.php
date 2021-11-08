<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['user_id', 'name', 'city', 'address', 'account_number', 'id_number', 'zip_code', 'tax_number', 'email', 'phone_number'];


    public function invoices() {
        return $this->hasMany(Invoice::class);
    }
    public function user() {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function items() {
        return $this->hasManyThrough(Item::class, Invoice::class);
    }
  

  public function totalSum(){
      $items = $this->items;
      $total = 0;
        
      foreach ($items as $one){
          $total += (($one->quantity * $one->price) + (($one->quantity * $one->price)/100 * $one->pdv));

      }
      return $total;
  }

    
}
