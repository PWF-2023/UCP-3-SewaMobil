<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Car extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'brand',
        'type',
        'license',
        'price',
        'ready',
        // 'image',
    ];

    protected $casts = [
        'ready' => 'boolean',
    ];

    public function rental()
    {
        return $this->hasMany(Rental::class);
    }
}
