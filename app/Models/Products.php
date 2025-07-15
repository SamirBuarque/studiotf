<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Products extends Model
{

    protected $fillable = [
        "name",
        "quantity",
        "checked"
    ];

    public function eventRecord() {
        return $this->belongsTo(EventRecord::class);
    }
}
