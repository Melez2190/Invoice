<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Client;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'date_of_issue', 'valuta'];
    
    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    public function user() {
        return $this->client->user;
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

    public function scopeFilter($query, array $filters)
    {
      
       
        $query->when($filters['client_name'] ?? false, fn ($query, $client_name)=>
            $query
                ->whereRelation('client', 'name', 'like', '%' . $client_name . '%'));
        
        $query->when($filters['date_of_issue'] ?? false, fn ($query, $date_of_issue)=>
            $query
                ->where('date_of_issue', '>=', $date_of_issue ));

        $query->when($filters['to_date_of_issue'] ?? false, fn ($query, $to_date_of_issue)=>
            $query
                ->where('date_of_issue', '<=', $to_date_of_issue ));

        $query->when($filters['valuta'] ?? false, fn ($query, $valuta)=>
            $query
                ->where('valuta', '>=', $valuta ));

        $query->when($filters['tovaluta'] ?? false, fn ($query, $tovaluta)=>
            $query
                ->where('valuta', '<=', $tovaluta ));

        $query->when($filters['status_true'] ?? false, fn ($query, $status_true)=>
            $query
                ->where('status', '=', $status_true ));

        $query->when($filters['status_0'] ?? false, fn($query, $status_0)=>
            $query
                ->where('status', '=', $status_0));

      
    }
    public function total() {
        $items = $this->items;
        $total = 0;
        foreach($items as $item){
            $total += ($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv;
            

        }
        return $total;
    }
    public function totalOne() {
        $items = $this->items;
        $total = 0;
        foreach($items as $item){
            

        }
        return  (($item->quantity * $item->price)+(($item->quantity * $item->price)/100)*$item->pdv);
      
    }
}
