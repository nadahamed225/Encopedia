<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Shipment extends Model
{
    use HasFactory;
    protected $fillable = [
        'code','shipper','image','weight','description','price','status','updated_by','created_at','updated_at'
    ];
    public function journal_entities():HasMany{
        return $this->hasMany(JournalEntities::class);
    }
}
