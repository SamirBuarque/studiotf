<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Workers extends Model
{
    use HasFactory;
    protected $fillable = [
        "name",
        "event_record_id",
        "birth_date",
        "position",
    ];

    protected $casts = [
        'birth_date' => 'date'
    ];

    public function eventRecord()
    {
        return $this->belongsTo(EventRecord::class);
    }
}
