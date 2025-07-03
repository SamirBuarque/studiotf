<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "event_record_id"
    ];

    public function eventRecord()
    {
        return $this->belongsTo(EventRecord::class);
    }
}
