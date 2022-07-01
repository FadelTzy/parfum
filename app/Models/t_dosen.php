<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\t_relasi;

class t_dosen extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function relasi()
    {
        return $this->hasMany(t_relasi::class, 'id_dosen', 'id_dosen');
    }
}
