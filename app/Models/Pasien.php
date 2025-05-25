<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pasien extends Model
{
    use HasFactory;

    protected $fillable = [
        'nama',
        'tanggal_lahir',
        'jenis_kelamin',
        'no_hp',
    ];

    public function pemeriksaans()
    {
        return $this->hasMany(Pemeriksaan::class);
    }

    public function reseps()
    {
        return $this->hasMany(Resep::class);
    }


}
