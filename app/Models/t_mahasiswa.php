<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class t_mahasiswa extends Model
{
    use HasFactory;
    protected $guarded = [];
    public function relasi()
    {
        return $this->belongsTo(t_relasi::class, 'nim', 'nim');
    }
    public function sks()
    {
        return $this->hasMany(prestasi::class, 'nim', 'nim');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'nim', 'username')->select(['foto']);
    }
    public function konsultasi()
    {
        return $this->hasMany(t_konsultasi::class, 'id_relasi', 'id');
    }
}
