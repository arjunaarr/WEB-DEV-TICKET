<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kategori extends Model
{
    use HasFactory;

    
    protected $fillable = [
        'nama',
    ];

    /**
     * Relasi ke model Event.
     * Satu kategori bisa menampung banyak event.
     */
    public function events()
    {
        return $this->hasMany(Event::class);
    }
}