<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pemeriksaan extends Model
{
    use HasFactory;

    protected $fillable = [
        'pasien_id',
        'berat_badan', 
        'tekanan_darah', 
        'keluhan',
        'diagnosa',
    ];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }

}
