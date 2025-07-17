<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

class EventsInventory extends Pivot
{
    protected $table = 'events_inventory';
    protected $fillable = [
        'id',
        'event_record_id',
        'inventory_id',
        'reserved'
    ];
}
