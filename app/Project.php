<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

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

    public function webhooks()
    {
        return $this->hasMany(Webhook::class);
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function getBillingDetails()
    {
        return view('partials.billing_to', ['project' => $this])->render();
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            static::addGlobalScope('user_project', function (Builder $builder) {
                $builder->whereHas('team', function ($q) {
                    $q->whereIn('id', auth()->user()->teams->pluck('id')->toArray())
                    ->orWhere('owner_id', auth()->user()->id)
                    ->orWhere('leader_id', auth()->user()->id);
                });
            });
        }
    }
}
