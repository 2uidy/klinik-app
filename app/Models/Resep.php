<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Resep extends Model
{
    use HasFactory;

    protected $fillable = ['nomor_resep', 'pemeriksaan_id', 'pasien_id'];

    public function obats()
    {
        return $this->hasMany(Obat::class);
    }

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

     public function pemeriksaan()
    {
        return $this->belongsTo(Pemeriksaan::class);
    }

}
