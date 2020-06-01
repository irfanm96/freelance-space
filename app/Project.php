<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    protected $guarded = [];

    protected $casts = [
        'type' => 'array'
    ];
    public function tasks()
    {
        return $this->hasMany(Task::class);
    }
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
