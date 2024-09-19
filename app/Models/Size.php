<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;

    protected $fillable = ['size', 'is_active', 'suit_id'];

    public function suit()
    {
        return $this->belongsTo(Suit::class);
    }
}
