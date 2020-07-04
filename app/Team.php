<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class Team extends Model
{
    protected $guarded = [];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }

    public function leader()
    {
        return $this->belongsTo(User::class, 'leader_id');
    }

    public function owner()
    {
        return $this->belongsTo(User::class, 'owner_id');
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            static::addGlobalScope('user_team', function (Builder $builder) {
                $builder->whereHas('users', function ($q) {
                    $q->whereIn('users.id', User::all()->pluck('id')->toArray());
                })->orWhere('owner_id', auth()->user()->id)
                ->orWhere('leader_id', auth()->user()->id);
            });
        }
    }
}
