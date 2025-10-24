<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Booking extends Model
{
    use HasFactory;

    const STATUS_MENUNGGU = 'belum_bayar';
    const STATUS_DIBAYAR = 'dibayar';
    const STATUS_DISETUJUI = 'disetujui';
    const STATUS_DIBATALKAN = 'dibatalkan';


    protected $fillable = ['user_id', 'datakost_id', 'checkin_date', 'status', 'kode_booking', 'bukti_pembayaran'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public function kost()
    {
        return $this->belongsTo(Datakost::class, 'datakost_id');
    }
}
