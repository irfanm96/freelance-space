<?php

namespace App;

use Spatie\Permission\Traits\HasRoles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;
    use HasRoles;
    // use Impersonate,

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function teams()
    {
        return $this->belongsToMany(Team::class);
    }

    public function bankDetails()
    {
        return $this->hasMany(BankDetail::class);
    }

    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    /**
    * @return bool
    */
    public function canImpersonate()
    {
        return $this->hasRole('super-admin');
    }

    /**
     * @return bool
     */
    public function canBeImpersonated()
    {
        return !$this->hasRole('super-admin');
    }

    protected static function booted()
    {
        if (auth()->check() && !auth()->user()->hasRole('super-admin')) {
            static::addGlobalScope('user', function (Builder $builder) {
                $builder->where('users.id', auth()->user()->id);
            });
        }
    }
}
