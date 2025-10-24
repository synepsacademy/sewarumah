<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Datakost extends Model
{
    use HasFactory;

    protected $table = 'datakosts';

    protected $fillable = [
        'nama_kost',
        'harga',
        'alamat',
        'jumlah_kamar',
        'kota_id',
        'foto_1',
        'foto_2',
        'foto_3',
        'map'
    ];



    public function kota()
    {
        return $this->belongsTo(Kota::class);
    }

    public function fasilitas()
    {
        return $this->belongsToMany(Fasilitas::class, 'kost_fasilitas');
    }
}
