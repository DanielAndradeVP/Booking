<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Booking extends Model
{
    use HasFactory;

    protected $fillable = [
        'guest_name',
        'guest_email',
        'start_date',
        'end_date',
        'service_id',
    ];

    protected $hidden = [
        'created_at',
        'update_at',
    ];

    public function service(): BelongsTo
    {
        return $this->belongsTo(Service::class);
    }
}
