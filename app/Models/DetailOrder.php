<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrder extends Model
{
    use HasFactory;


    protected $fillable = [
        'order_id',
        'tiket_id',
        'jumlah',
        'subtotal_harga',
    ];

    /**
     * Relasi ke model Order.
     * Setiap detail order merupakan bagian dari satu order utama.
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Relasi ke model Tiket.
     * Setiap detail order mengacu pada satu jenis tiket tertentu.
     */
    public function tiket()
    {
        return $this->belongsTo(Tiket::class);
    }
}