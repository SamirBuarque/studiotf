<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    protected $fillable = [
        "path",
        "original_name",
        "mime_type",
        "size",
        "extension",
        "event_record_id"
    ];

    public function eventRecord() {
        return $this->belongsTo(EventRecord::class);
    }

}
