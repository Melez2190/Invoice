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


    public function invoice() {
        return $this->hasMany(Invoice::class);
    }

    
}
