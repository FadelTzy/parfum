<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_konsultasi extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function topik()
    {
        return $this->hasOne(t_topik::class, 'id', 'id_topik');
    }
}
