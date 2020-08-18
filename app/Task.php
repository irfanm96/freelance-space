<?php

namespace App;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    protected $guarded = [];

    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function invoices()
    {
        return $this->belongsToMany(Invoice::class);
    }

    protected static function booted()
    {
        if (auth()->check() && ! auth()->user()->hasRole('super-admin')) {
            static::addGlobalScope('user_task', function (Builder $builder) {
                $builder->whereIn('project_id', Project::all()->pluck('id')->toArray());
            });
        }
    }
}
