<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;
    protected $guarded =[];
    public function oCustomer()
    {
        return $this->hasOne(customer::class, 'id', 'id_user');
    }
}
