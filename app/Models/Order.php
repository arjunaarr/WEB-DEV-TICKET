<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    
    protected $casts = [
        'total_harga' => 'decimal:2',
        'order_date' => 'datetime',
    ];

    
    protected $fillable = [
        'user_id',
        'event_id',
        'order_date',
        'total_harga',
    ];

    /**
     * Relasi ke model User.
     * Order dimiliki oleh satu user yang melakukan pemesanan.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Relasi Many-to-Many ke model Tiket melalui tabel pivot detail_orders.
     * Mengambil daftar tiket yang ada dalam order ini beserta jumlah dan subtotalnya.
     */
    public function tikets()
    {
        return $this->belongsToMany(Tiket::class, 'detail_orders')
            ->withPivot('jumlah', 'subtotal_harga');
    }

    /**
     * Relasi ke model Event.
     * Order terkait dengan satu event tertentu.
     */
    public function event()
    {
        return $this->belongsTo(Event::class, 'event_id');
    }

    /**
     * Relasi ke model DetailOrder.
     * Satu order bisa memiliki banyak detail (item) pembelian.
     */
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }
}