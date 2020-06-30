<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    protected $guarded = [];
    protected $casts = [
        'date' => 'date'
    ];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function tasks()
    {
        return $this->belongsToMany(Task::class);
    }

    public function bankDetail()
    {
        return $this->belongsTo(BankDetail::class);
    }
}
