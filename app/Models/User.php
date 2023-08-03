<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class User extends Model
{
    use HasFactory;
    public function otps(): HasOne{

        return $this->hasOne(OTP::class);
    }
    public function project_users(): HasMany
    {
        return $this->hasMany(ProjectUser::class);
    }
    public function projects(): BelongsToMany
    {
        return $this->belongsToMany(Project::class);
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
