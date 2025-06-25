<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Planning extends Model
{
    protected $fillable = [
        "text",
        "checked",
        "completed"
    ];

    public function eventRecord() {
        return $this->belongsTo(EventRecord::class);
    }
}
