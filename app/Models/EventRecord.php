<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EventRecord extends Model
{
    /** @use HasFactory<\Database\Factories\EventRecordFactory> */
    use HasFactory;

    protected $fillable = [
        "name",
        "city",
        "state",
        "date",
        "status"
    ];

    protected $casts = [
        'date' => 'DD-MM-YYYY'
    ];

    protected function casts(): array
    {
        return [
            'date' => 'datetime',
        ];
    }

    public function planning() {
        return $this->hasMany(Planning::class);
    }

    public function products() {
        return $this->hasMany(Products::class);
    }

    public function workers() {
        return $this->hasMany(Workers::class);
    }

    public function file() {
        return $this->hasMany(File::class);
    }
}
