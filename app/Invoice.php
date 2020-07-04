<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('user_id', auth()->user()->id);
            });
        }
    }
}
