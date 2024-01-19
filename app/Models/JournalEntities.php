<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class JournalEntities extends Model
{
    use HasFactory;
    protected $fillable = [
        'amount','type','shipment'
    ];
    public function shipment(): BelongsTo
    {
        return $this->belongsTo(Shipment::class);
    }
}
