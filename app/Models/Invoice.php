<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\Client;
use App\Scopes\TenantScope;
use Illuminate\Notifications\Notifiable;

class Invoice extends Model
{
    use HasFactory, SoftDeletes, Notifiable;
    
    protected $table = 'invoices';
    protected $primaryKey = 'id';
    protected $fillable = ['client_id', 'date_of_issue', 'valuta', 'created_by', 'updated_by', 'user_id'];
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

    public function client() {
        return $this->belongsTo(Client::class, 'client_id');
    }
    
  
    public function user() {
        return $this->client->user;
    }
    // public function user(){
    //     return $this->
    // }

    public function items() {
        return $this->hasMany(Item::class);
    }


    // public function scopeFilter( $query, $from_date=null, $to_date=null ){

    //     if( !empty( $from_date ) ){
    //         $from_date = date('Y-m-d 00:00:01', strtotime( $from_date ) );
    
    //         $to_date = ( !empty( $to_date ) )? date('Y-m-d 23:59:59', strtotime( $to_date ) ) : date('Y-m-d 23:59:59' );
    
    //         $query->whereBetween( 'created_at', [ $from_date, $to_date ] );
    //     }
    
    //     return $query;
    // }
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

        // $query->when($filters['status'] ?? false, fn($query, $status)=>
        //     $query
        //         ->where('status', '=', $status ));

        $query->when($filters['status_true'] ?? false, fn ($query, $status_true)=>
            $query
                ->where('status', '=', $status_true ));

        if(isset($filters['status'])){
            $query->where('status', request('status'));
        }
    }

      
    // }
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
