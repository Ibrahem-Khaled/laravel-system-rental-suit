<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Suit extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'color', 'gender', 'product_type', 'is_active'];

    public function sizes()
    {
        return $this->hasMany(Size::class);
    }

    public function reservations()
    {
        return $this->hasMany(Reservation::class);
    }
}
