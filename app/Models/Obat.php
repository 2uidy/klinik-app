<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Obat extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama_obat',
        'jenis',
        'dosis',
        'quantity',
        'resep_id'
    ];

    public function resep()
    {
        return $this->belongsTo(Resep::class);
    }

}
