<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Service extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'name',
        'description',
        'price',
        'capacity',
        'location',
        'status',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function booking(): HasMany
    {
        return $this->hasMany(Booking::class);
    }
}
