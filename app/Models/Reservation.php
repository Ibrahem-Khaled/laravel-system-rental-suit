<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'suit_id',
        'size_id',
        'name',
        'phone',
        'include_pants',
        'include_vest',
        'include_tie',
        'include_bow_tie',
        'include_pocket_square',
        'reservation_date',
        'return_date',
        'height',
        'waist',
        'thighs',
        'calves',
        'slim',
        'notes',
        'is_received',
        'price',
    ];

    public function suit()
    {
        return $this->belongsTo(Suit::class);
    }

    public function size()
    {
        return $this->belongsTo(Size::class);
    }
}
