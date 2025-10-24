<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kota extends Model
{
    use HasFactory;

    // Nama tabel (optional kalau default-nya udah bener: 'kotas')
    protected $table = 'kotas';

    // Kolom yang bisa diisi
    protected $fillable = [
        'nama_kota',
        'gambar_kota',
    ];

    // Kalau kamu pakai timestamps (created_at, updated_at) bisa diaktifkan
    public $timestamps = true;

    public function kosts()
    {
        return $this->hasMany(Datakost::class);
    }
}
