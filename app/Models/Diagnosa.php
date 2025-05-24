<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Diagnosa extends Model
{
    use HasFactory;

    // Override nama tabel supaya cocok dengan database
    protected $table = 'diagnosa';

    protected $fillable = ['pasien_id', 'keluhan', 'diagnosa'];

    public function pasien()
    {
        return $this->belongsTo(Pasien::class);
    }
}
