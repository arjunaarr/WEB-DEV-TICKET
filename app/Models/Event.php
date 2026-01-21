<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'judul',
        'deskripsi',
        'tanggal_waktu',
        'lokasi',
        'kategori_id',
        'gambar',
    ];

  
    protected $casts = [
        'tanggal_waktu' => 'datetime',
    ];

    /**
     * Relasi ke model Tiket.
     * Satu event bisa memiliki banyak jenis tiket (misal: VIP, Regular).
     */
    public function tikets()
    {
        return $this->hasMany(Tiket::class);
    }

    /**
     * Relasi ke model Kategori.
     * Setiap event termasuk dalam satu kategori (misal: Musik, Olahraga).
     */
    public function kategori()
    {
        return $this->belongsTo(Kategori::class);
    }

    /**
     * Relasi ke model User (Pembuat Event).
     * Event dibuat oleh satu user (admin/organizer).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}