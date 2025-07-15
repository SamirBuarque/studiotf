<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Inventory extends Model
{
    protected $table = 'inventory';
    protected $fillable = [
        'name',
        'category',
        'total_quantity'
    ];

    public function eventRecord() {
        return $this->belongsToMany(EventRecord::class, 'events_inventory')
            ->withPivot('reserved')
            ->withTimestamps();
    }
}
