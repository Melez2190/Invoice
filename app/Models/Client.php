<?php

namespace App\Models;

use App\Scopes\TenantScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Client extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Notifiable;
    
    protected $table = 'clients';
    protected $primaryKey = 'id';
    protected $fillable = ['id', 'user_id', 'name', 'city', 'address', 'account_number', 'id_number', 'zip_code', 'tax_number', 'email', 'phone_number'];
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
        return $this->hasMany(Invoice::class);
    }
    public function user() {
        return $this->belongsTo(User::class, ['user_id', 'updated_by']);
    }
    

    public function items() {
        return $this->hasManyThrough(Item::class, Invoice::class);
    }
  
    public function scopeFilter($query, array $filters)
    {
       
       
        $query->when($filters['client_name'] ?? false, fn ($query, $client_name)=>
            $query
                ->where('name', 'like', '%' . $client_name . '%'));

        $query->when($filters['city'] ?? false, fn ($query, $city)=>
            $query
                ->where('city', 'like', '%' . $city . '%')); 

        $query->when($filters['email'] ?? false, fn ($query, $email)=>
            $query
                ->where('email', 'like', '%' . $email . '%'));
                
        $query->when($filters['tax_number'] ?? false, fn ($query, $tax_number)=>
            $query
                ->where('tax_number', 'like', '%' . $tax_number . '%'));

        $query->when($filters['id_number'] ?? false, fn ($query, $id_number)=>
            $query
                ->where('id_number', 'like', '%' . $id_number . '%'));
        
      
    }


    public function totalSum(){
        $invoices = $this->invoices;
        $invoices->load('items');
        $total = 0;

        foreach($invoices as $invoice){
            if($invoice->status === 0 ){
                foreach ($invoice->items as $one){
                    $total += (($one->quantity * $one->price) + (($one->quantity * $one->price)/100 * $one->pdv));
        
                }
            }
        }
        return $total;
    }
    public function totalnotPaid(){
        $invoices = $this->invoices;
        $invoices->load('items');
        $total = 0;

        foreach($invoices as $invoice){
            if($invoice->status === 1 ){
                foreach ($invoice->items as $one){
                    $total += (($one->quantity * $one->price) + (($one->quantity * $one->price)/100 * $one->pdv));
        
                }
            }
        }
        return $total;
    }
    public static function fetchAllClients() {
        $user = User::getUser();
        $collection = Client::with('invoices')->where('user_id', $user->id);
        $clients = $collection->orderBy('name', 'ASC')->paginate(10);
        
        return $clients;
    }







    // function allposts_count()
    // {   
    //     $query = $this
    //             ->db
    //             ->get('posts');
    
    //     return $query->num_rows();  

    // }
    
    // function allposts($limit,$start,$col,$dir)
    // {   
    //    $query = $this
    //             ->db
    //             ->limit($limit,$start)
    //             ->order_by($col,$dir)
    //             ->get('posts');
        
    //     if($query->num_rows()>0)
    //     {
    //         return $query->result(); 
    //     }
    //     else
    //     {
    //         return null;
    //     }
        
    // }
   
    // function posts_search($limit,$start,$search,$col,$dir)
    // {
    //     $query = $this
    //             ->db
    //             ->like('id',$search)
    //             ->or_like('title',$search)
    //             ->limit($limit,$start)
    //             ->order_by($col,$dir)
    //             ->get('posts');
        
       
    //     if($query->num_rows()>0)
    //     {
    //         return $query->result();  
    //     }
    //     else
    //     {
    //         return null;
    //     }
    // }

    // function posts_search_count($search)
    // {
    //     $query = $this
    //             ->db
    //             ->like('id',$search)
    //             ->or_like('title',$search)
    //             ->get('posts');
    
    //     return $query->num_rows();
    // } 
   
        
}
