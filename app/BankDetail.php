<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

class BankDetail extends Model
{
    protected $guarded = [];

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
