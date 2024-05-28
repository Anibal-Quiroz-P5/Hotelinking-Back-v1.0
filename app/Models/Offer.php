<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Offer extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'description',
        'image',
        'promotional_code',
        'user_id',
    ];

    // Relación con el modelo User (si es necesario)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}