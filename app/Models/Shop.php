<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shop extends Model
{
    use HasFactory;

    protected $with = ['promo'];

    protected $fillable = [
        'user_id',
        'image',
        'name',
        'location',
        'city',
        'delivery',
        'pickup',
        'whatsapp',
        'description',
        'price',
        'rate',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function promo()
    {
        return $this->hasOne(Promo::class);
    }

    public function laundries()
    {
        return $this->hasMany(Laundry::class);
    }
}
