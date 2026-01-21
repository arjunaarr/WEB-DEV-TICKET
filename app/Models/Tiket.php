<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tiket extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'event_id',
        'tipe',
        'harga',
        'stok',
    ];

    /**
     * Relasi ke model Event.
     * Tiket ini milik event mana.
     */
    public function event()
    {
        return $this->belongsTo(Event::class);
    }

    /**
     * Relasi ke model DetailOrder.
     * Tiket ini bisa muncul di banyak detail order (history pembelian).
     */
    public function detailOrders()
    {
        return $this->hasMany(DetailOrder::class);
    }

    /**
     * Relasi Many-to-Many ke model Order.
     * Mengetahui order mana saja yang membeli tiket ini.
     */
    public function orders()
    {
        return $this->belongsToMany(Order::class, 'detail_orders')
            ->withPivot('jumlah', 'subtotal_harga');
    }
}