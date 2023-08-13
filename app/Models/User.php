<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail // ,Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        //'id',
        'email',
        'password',
        'full_name',
        'user_type',
        'phone_number',
        'logo'


    ];
    // protected $nullable = [
    //     'logo'
    // ];
    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    // public function otps(): HasOne{

    //     return $this->hasOne(OTP::class);
    // }
    public function project_users(): HasMany
    {
        return $this->hasMany(ProjectUser::class);
    }

    public function requests(): HasMany
    {
        return $this->hasMany(Request::class);
    }

    public function resposes(): HasMany
    {
        return $this->hasMany(Response::class);
    }

}
