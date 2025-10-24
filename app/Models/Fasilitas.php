<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;


class Fasilitas extends Model
{
    protected $fillable = ['nama_fasilitas', 'icon'];

    public function kosts()
    {
        return $this->belongsToMany(Datakost::class, 'kost_fasilitas');
    }
}
