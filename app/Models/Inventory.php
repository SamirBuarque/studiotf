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

    protected $appends = ['available_quantity'];

    public function eventRecord() {
        return $this->belongsToMany(EventRecord::class, 'events_inventory')
            ->withPivot('reserved')
            ->withTimestamps();
    }

    public function getAvailableQuantityAttribute() {
        $total = $this->total_quantity;
        $reserved = $this->eventRecord()->sum('reserved');
        return $total - $reserved;
    }
}
